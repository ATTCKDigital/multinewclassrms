import FLEX from 'FLEX/js/clientNamespace';

// import your child components
import Nav from '../components/component_nav/nav';
import Carousel from '../components/component_carousel/carousel';
import ContactForm from '../components/component_contact-form/contact-form';
import DropdownSection from '../components/component_dropdown-section/dropwdown-section';
import LogoAnimation from '../components/component_logo-animation/logo-animation';
import TestimonialCarousel from "../gutenberg/blocks/block_testimonialcarousel/testimonialcarousel";
import CircleImage from "../gutenberg/blocks/block_circle-image/circle-image";

// then add them to this object
FLEX.ChildComponents = {
    'Nav': Nav,
    'Carousel': Carousel,
    'TestimonialCarousel': TestimonialCarousel,
    'DropdownSection': DropdownSection,
    'CircleImage': CircleImage,
    'LogoAnimation': LogoAnimation,
};

// Custom code non related to FLEX
// TODO: Move this into a FLEX component. -DP
ContactForm();
