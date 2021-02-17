import FLEX from 'FLEX/js/clientNamespace';

// FLEX components
import Nav from '../components/component_nav/nav';
import Carousel from '../components/component_carousel/carousel';
import ColorTile from '../components/component_colortile/colortile';
import ContactForm from '../components/component_contact-form/contact-form';
import VideoPopup from '../components/component_video-popup/video-popup';
import DropdownSection from '../components/component_dropdown-section/dropwdown-section';

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
  'VideoPopup': VideoPopup,
  'DropdownSection': DropdownSection,
};

// Custom code non related to FLEX
// TODO: Move this into a FLEX component. -DP
ContactForm();