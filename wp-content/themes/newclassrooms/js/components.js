import FLEX from 'FLEX/js/clientNamespace';
// import your child components
import Nav from '../components/component_nav/nav';
import Carousel from '../components/component_carousel/carousel';

// Blocks
import TestimonialCarousel from '../gutenberg/blocks/block_testimonialcarousel/testimonialcarousel';
import HeroSlider from '../gutenberg/blocks/block_hero-slider/hero-slider';

// then add them to this object
FLEX.ChildComponents = {
  'Carousel': Carousel,
  'Nav': Nav,
  'TestimonialCarousel': TestimonialCarousel,
  'HeroSlider': HeroSlider
};
