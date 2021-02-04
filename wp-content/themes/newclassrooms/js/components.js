import FLEX from 'FLEX/js/clientNamespace';

// FLEX components
import Nav from '../components/component_nav/nav';
import Carousel from '../components/component_carousel/carousel';
import ColorTile from '../components/component_colortile/colortile';
import VideoPopup from '../components/component_video-popup/video-popup';

// Gutenberg blocks
import HeroSlider from '../gutenberg/blocks/block_hero-slider/hero-slider';
import TestimonialCarousel from '../gutenberg/blocks/block_testimonialcarousel/testimonialcarousel';

// then add them to this object
FLEX.ChildComponents = {
  'Carousel': Carousel,
  'ColorTile': ColorTile,
  'HeroSlider': HeroSlider,
  'Nav': Nav,
  'TestimonialCarousel': TestimonialCarousel,
  'VideoPopup': VideoPopup
};
