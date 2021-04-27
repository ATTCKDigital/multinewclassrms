import FLEX from 'FLEX/js/client-namespace';

// FLEX components
import Carousel from '../components/component_carousel/carousel';
import ColorTile from '../components/component_colortile/colortile';
import ContactForm from '../components/component_contact-form/contact-form';
import DropdownSection from '../components/component_dropdown-section/dropdown-section';
import FeaturesCard from '../components/component_features-card/features-card';
import Nav from '../components/component_nav/nav';
import VideoPopup from '../components/component_video-popup/video-popup';

// Gutenberg blocks
import HeroSlider from '../gutenberg/blocks/block_hero-slider/hero-slider';
import TestimonialCarousel from '../gutenberg/blocks/block_testimonialcarousel/testimonialcarousel';

// then add them to this object
FLEX.ChildComponents = {
  'Carousel': Carousel,
  'ColorTile': ColorTile,
  'DropdownSection': DropdownSection,
  'FeaturesCard': FeaturesCard,
  'HeroSlider': HeroSlider,
  'Nav': Nav,
  'TestimonialCarousel': TestimonialCarousel,
  'VideoPopup': VideoPopup
};

// Custom code non related to FLEX
// TODO: Move this into a FLEX component. -DP
ContactForm();