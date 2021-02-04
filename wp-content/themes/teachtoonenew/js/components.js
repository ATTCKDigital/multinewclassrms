import FLEX from 'FLEX/js/clientNamespace';

// import your child components
import Nav from '../components/component_nav/nav';
import Carousel from '../components/component_carousel/carousel';
import ContactForm from '../components/component_contact-form/contact-form';
import TestimonialCarousel from "../gutenberg/blocks/block_testimonialcarousel/testimonialcarousel";

// then add them to this object
FLEX.ChildComponents = {
    'Nav': Nav,
    'Carousel': Carousel,
    'TestimonialCarousel': TestimonialCarousel,
};

// Custom code non related to FLEX
// TODO: Move this into a FLEX component. -DP
ContactForm();
