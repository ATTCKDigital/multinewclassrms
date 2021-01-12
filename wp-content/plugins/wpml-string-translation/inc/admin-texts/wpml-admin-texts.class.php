<?php

use WPML\Collect\Support\Collection;
use \WPML\FP\Wrapper;
use \WPML\FP\Obj;
use function WPML\Container\make;
use function \WPML\FP\partial;
use function \WPML\FP\invoke;
use function \WPML\FP\Strings\match;
use function \WPML\FP\flip;

class WPML_Admin_Texts extends WPML_Admin_Text_Functionality {
	const DOMAIN_NAME_PREFIX = 'admin_texts_';
	const FIND_KEYS_REGEX    = '#\[([^\]]+)\]#';

	/** @var array $cache - A cache for each option translation */
	private $cache = [];

	/** @var array $option_names - The option names from Admin texts settings */
	private $option_names = [];

	/** @var  TranslationManagement $tm_instance */
	private $tm_instance;

	/** @var  WPML_String_Translation $st_instance */
	private $st_instance;

	/** @var bool $lock */
	private $lock = false;

	/**
	 * @param TranslationManagement   $tm_instance
	 * @param WPML_String_Translation $st_instance
	 */
	function __construct( &$tm_instance, &$st_instance ) {
		add_action( 'plugins_loaded', [ $this, 'icl_st_set_admin_options_filters' ], 10 );
		add_filter( 'wpml_unfiltered_admin_string', flip( [ $this, 'get_option_without_filtering' ] ), 10, 2 );
		$this->tm_instance = &$tm_instance;
		$this->st_instance = &$st_instance;
	}

	/**
	 * @param mixed $value
	 *
	 * @return array|mixed|object
	 */
	private static function object_to_array( $value ) {
		return is_object( $value ) ? object_to_array( $value ) : $value;
	}

	function icl_register_admin_options( $array, $key = "", $option = array() ) {
		$option = self::object_to_array( $option );
		foreach ( $array as $k => $v ) {
			$option = $key === '' ? array( $k => maybe_unserialize( $this->get_option_without_filtering( $k ) ) ) : $option;
			if ( is_array( $v ) ) {
				$this->icl_register_admin_options( $v, $key . '[' . $k . ']', $option[ $k ] );
			} else {
				$context = $this->get_context( $key, $k );
				if ( $v === '' ) {
					icl_unregister_string( $context, $key . $k );
				} elseif ( isset( $option[ $k ] ) && ( $key === '' || preg_match_all( self::FIND_KEYS_REGEX,
							(string) $key,
							$opt_key_matches ) > 0 )
				) {
					icl_register_string( $context, $key . $k, $option[ $k ], true );
					$vals     = array( $k => 1 );
					$opt_keys = isset( $opt_key_matches ) ? array_reverse( $opt_key_matches[1] ) : array();
					foreach ( $opt_keys as $opt ) {
						$vals = array( $opt => $vals );
					}
					update_option( '_icl_admin_option_names',
						array_merge_recursive( (array) get_option( '_icl_admin_option_names' ), $vals ) );
					$this->option_names = [];
				}
			}
		}
	}

	public function getModelForRender() {
		return $this->getModel( $this->getOptions() );
	}

	/**
	 * @param Collection $options
	 *
	 * @return Collection
	 */
	public function getModel( Collection $options ) {
		$stringNamesPerContext = $this->getStringNamesPerContext();

		$isRegistered = function ( $context, $name ) use ( $stringNamesPerContext ) {
			return $stringNamesPerContext->has( $context ) &&
			       $stringNamesPerContext->get( $context )->contains( $name );
		};

		$getItems = partial( [ $this, 'getItemModel' ], $isRegistered );

		return $options->map( $getItems )
		               ->filter()
		               ->values()
		               ->reduce( [ $this, 'flattenModelItems' ], wpml_collect() );
	}


	/**
	 * @param Collection $flattened
	 * @param array      $item
	 *
	 * @return Collection
	 */
	public function flattenModelItems( Collection $flattened, array $item ) {
		if ( empty( $item ) ) {
			return $flattened;
		}

		if ( isset( $item['items'] ) ) {
			return $flattened->merge(
				$item['items']->reduce( [ $this, 'flattenModelItems' ], wpml_collect() )
			);
		}

		return $flattened->push( $item );
	}

	/**
	 * @param  callable  $isRegistered  - string -> string -> bool
	 * @param  mixed  $value
	 * @param  string  $name
	 * @param  string  $key
	 * @param  array  $stack
	 *
	 * @return array
	 */
	public function getItemModel( callable $isRegistered, $value, $name, $key = '', $stack = [] ) {
		$sub_key = $this->getSubKey( $key, $name );

		$result = [];

		if ( $this->isMultiValue( $value ) ) {
			$stack[] = $value;

			$getSubItem      = function ( $v, $key ) use ( $isRegistered, $sub_key, $stack ) {
				return $this->getItemModel( $isRegistered, $v, $key, $sub_key, $stack );
			};
			$result['items'] = wpml_collect( $value )
				->reject( $this->isOnStack( $stack ) )
				->map( $getSubItem );
		} else if ( is_string( $value ) || is_numeric( $value ) ) {
			$context    = $this->get_context( $key, $name );
			$stringName = $this->getDBStringName( $key, $name );

			$result['value']           = $value;
			$result['fixed']           = $this->is_sub_key_fixed( $sub_key );
			$result['name']            = $sub_key;
			$result['registered']      = $isRegistered( $context, $stringName );
			$result['hasTranslations'] = ! $result['fixed'] && $result['registered']
			                             && icl_st_string_has_translations( $context, $stringName );
		}

		return $result;

	}

	private function isOnStack( array $stack ) {
		return function ( $item ) use ( $stack ) {
			return \wpml_collect( $stack )->first( function ( $currentItem ) use ( $item ) {
					return $currentItem === $item;
				} ) !== null;
		};
	}

	private function is_sub_key_fixed( $sub_key ) {
		if ( $fixed = ( preg_match_all( self::FIND_KEYS_REGEX, $sub_key, $matches ) > 0 ) ) {

			$fixed_settings = $this->tm_instance->admin_texts_to_translate;
			foreach ( $matches[1] as $m ) {
				if ( $fixed = isset( $fixed_settings[ $m ] ) ) {
					$fixed_settings = $fixed_settings[ $m ];
				} else {
					break;
				}
			}
		}

		return $fixed;
	}

	private function get_context( $option_key, $option_name ) {
		return self::DOMAIN_NAME_PREFIX . ( preg_match( self::FIND_KEYS_REGEX, (string) $option_key, $matches ) === 1 ? $matches[1] : $option_name );
	}

	public function getOptions() {
		return wpml_collect( wp_load_alloptions() )
			->reject( flip( [ $this, 'is_blacklisted' ] ) )
			->map( 'maybe_unserialize' );
	}

	function icl_st_set_admin_options_filters() {
		$option_names = $this->getOptionNames();

		foreach ( $option_names as $option_key => $option ) {
			if ( $this->is_blacklisted( $option_key ) ) {
				unset( $option_names[ $option_key ] );
				update_option( '_icl_admin_option_names', $option_names );
			} elseif ( $option_key != 'theme' && $option_key != 'plugin' ) { // theme and plugin are an obsolete format before 3.2
				add_filter( 'option_' . $option_key, array( $this, 'icl_st_translate_admin_string' ) );
				add_action( 'update_option_' . $option_key, array( $this, 'on_update_original_value' ), 10, 3 );
			}
		}
	}

	function icl_st_translate_admin_string( $option_value, $key = "", $name = "", $root_level = true ) {
		if ( $root_level && $this->lock ) {
			return $option_value;
		}

		$this->lock = true;

		global $sitepress;
		$lang        = $sitepress->get_current_language();
		$option_name = substr( current_filter(), 7 );
		$name        = $name === '' ? $option_name : $name;
		$blog_id     = get_current_blog_id();

		if ( isset( $this->cache[ $blog_id ][ $lang ][ $name ] ) ) {
			$this->lock = false;

			return $this->cache[ $blog_id ][ $lang ][ $name ];
		}

		$is_serialized = is_serialized( $option_value );
		$option_value  = $is_serialized ? unserialize( $option_value ) : $option_value;

		if ( is_array( $option_value ) || is_object( $option_value ) ) {
			$option_value = $this->translate_multiple( $option_value, $key, $name );
		} else {
			$option_value = $this->translate_single( $option_value, $key, $name, $option_name );
		}

		$option_value = $is_serialized ? serialize( $option_value ) : $option_value;

		if ( $root_level ) {
			$this->lock                                = false;
			$this->cache[ $blog_id ][ $lang ][ $name ] = $option_value;
		}

		return $option_value;
	}

	/**
	 * @param string $key - string like '[key1][key2]'
	 * @param string $name
	 *
	 * @return bool
	 */
	private function isAdminText( $key, $name ) {
		return null !== Wrapper::of( $this->getSubKey( $key, $name ) )
		                       ->map( [ self::class, 'getKeysParts' ] )
		                       ->map( invoke( 'reduce' )->with( flip( Obj::prop() ), $this->getOptionNames() ) )
		                       ->get();
	}

	/**
	 * getKeys :: string [key1][key2][name] => Collection [key1, key2, name]
	 *
	 * @param string $option
	 *
	 * @return Collection
	 */
	public static function getKeysParts( $option ) {
		return match( self::FIND_KEYS_REGEX, $option )->getOrElse( wpml_collect() );
	}

	function clear_cache_for_option( $option_name ) {
		$blog_id = get_current_blog_id();
		if ( isset( $this->cache[ $blog_id ] ) ) {
			foreach ( $this->cache[ $blog_id ] as $lang_code => &$cache_data ) {
				if ( array_key_exists( $option_name, $cache_data ) ) {
					unset( $cache_data[ $option_name ] );
				}
			}
		}
	}

	/**
	 * @param string|array $old_value
	 * @param string|array $value
	 * @param string       $option_name
	 * @param string       $name
	 * @param string       $sub_key
	 */
	public function on_update_original_value( $old_value, $value, $option_name, $name = '', $sub_key = '' ) {
		global $sitepress, $wpdb;

		$name = $name ? $name : $option_name;

		$value     = self::object_to_array( $value );
		$old_value = self::object_to_array( $old_value );

		if ( is_array( $value ) ) {
			foreach ( array_keys( $value ) as $key ) {
				$this->on_update_original_value(
					isset( $old_value[ $key ] ) ? $old_value[ $key ] : '',
					$value[ $key ],
					$option_name,
					$key,
					$this->getSubKey( $sub_key, $name )
				);
			}
		} elseif ( $this->isAdminText( $sub_key, $name ) ) {
			$domain = self::DOMAIN_NAME_PREFIX . $option_name;

			if ( $sitepress->get_current_language() === $this->get_string_original_language( $domain, $old_value ) ) {
				icl_st_update_string_actions( $domain, $this->getDBStringName( $sub_key, $name ), $old_value, $value );
			} else {
				icl_update_string_translation(
					$option_name,
					$sitepress->get_current_language(),
					$value,
					ICL_STRING_TRANSLATION_COMPLETE
				);

				/**
				 * This method is invoked as the action handler on post update_option. Due to that,
				 * the option is already overridden by a translated string which is undesired.
				 * We always want to keep the option in English. Due to that, I have to restore its value.
				 */
				$wpdb->update( $wpdb->options, [ 'option_value' => $old_value ], [ 'option_name' => $option_name ] );
			}
		}

		if ( $sub_key === '' ) {
			$this->clear_cache_for_option( $option_name );
			/**
			 * I have to prefill the cache here because MO file with updated translation is generated on shutdown.
			 * Due to that, after saving the option, a user would see displayed the previous translation.
			 */
			$this->cache[ get_current_blog_id() ][ $sitepress->get_current_language() ][ $option_name ] = $value;
		}
	}

	/**
	 * @param string $domain
	 * @param string $value
	 *
	 * @return string
	 */
	private function get_string_original_language( $domain, $value ) {
		global $wpdb;

		$strings = new WPML_ST_DB_Mappers_Strings( $wpdb );
		$string  = $strings->getByDomainAndValue( $domain, $value );

		return $string ? $string->language : 'en';
	}

	public function migrate_original_values() {
		$migrate = function ( $option_name ) {
			$option_value = maybe_unserialize( $this->get_option_without_filtering( $option_name ) );
			$this->on_update_original_value( '', $option_value, $option_name );
		};
		wpml_collect( $this->getOptionNames() )
			->keys()
			->filter()
			->each( $migrate );
	}

	/**
	 * Returns a function to lazy load the migration
	 *
	 * @return Closure
	 */
	public static function get_migrator() {
		return function () { wpml_st_load_admin_texts()->migrate_original_values(); };
	}

	/**
	 * @param mixed  $option_value
	 * @param string $key
	 * @param string $name
	 *
	 * @return array|mixed
	 */
	private function translate_multiple( $option_value, $key, $name ) {
		$subKey = $this->getSubKey( $key, $name );

		foreach ( $option_value as $k => &$value ) {
			$value = $this->icl_st_translate_admin_string( $value,
				$subKey,
				$k,
				false );
		}

		return $option_value;
	}

	/**
	 * @param string $option_value
	 * @param string $key
	 * @param string $name
	 * @param string $option_name
	 *
	 * @return string
	 */
	private function translate_single( $option_value, $key, $name, $option_name ) {
		/**
		 * In update_option, we retrieve the old value of an option ( before update is completed ) and that value is passed via the action to on_update_original_value method.
		 * Unfortunately, this method used to translate the old value and I was received old "translated" value, instead of just the original old value.
		 */
		if ( $option_value !== '' && $this->isAdminText( $key, $name ) && ! $this->is_called_from_update_option() ) {
			global $sitepress;
			$has_translation = false;
			/**
			 * We have to pass the explicit current language parameter because otherwise `icl_translate` uses by default the profile language.
			 */
			$option_value    = icl_translate(
				self::DOMAIN_NAME_PREFIX . $option_name,
				$key . $name,
				$option_value,
				false,
				$has_translation,
				$sitepress->get_current_language()
			);
		}

		return $option_value;
	}

	/**
	 * @return bool
	 */
	private function is_called_from_update_option() {
		$debug = new \WPML\Utils\DebugBackTrace();

		return $debug->is_function_in_call_stack( 'update_option' );
	}

	/**
	 * @return array
	 */
	private function getOptionNames() {
		if ( empty( $this->option_names ) ) {
			$this->option_names = get_option( '_icl_admin_option_names' );
			if ( ! is_array( $this->option_names ) ) {
				$this->option_names = [];
			}
		}

		return $this->option_names;
	}

	/**
	 * getSubKeys :: string [key1][key2] -> string name => string [key1][key2][name]
	 *
	 * @param string $key - [key1][key2]
	 * @param string $name
	 *
	 * @return string
	 */
	private function getSubKey( $key, $name ) {
		return $key . '[' . $name . ']';
	}

	/**
	 * getSubKeys :: string [key1][key2] -> string name => string [key1][key2]name
	 *
	 * @param string $key
	 * @param string $name
	 *
	 * @return string
	 */
	private function getDBStringName( $key, $name ) {
		return $key . $name;
	}

	/**
	 * @return Collection
	 * @throws \Auryn\InjectionException
	 */
	private function getStringNamesPerContext() {
		$strings = make( WPML_ST_DB_Mappers_Strings::class )
			->get_all_by_context( self::DOMAIN_NAME_PREFIX . '%' );

		return wpml_collect( $strings )
			->groupBy( 'context' )
			->map( invoke( 'pluck' )->with( 'name' ) );
	}

	/**
	 * @param mixed $value
	 *
	 * @return bool
	 */
	private function isMultiValue( $value ) {
		return is_array( $value ) ||
		       ( is_object( $value ) && '__PHP_Incomplete_Class' !== get_class( $value ) );
	}
}
