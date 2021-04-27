import $ from 'jquery';
import FLEX from '../../../FLEX/js/client-namespace';

class ContactForm {
    constructor($cf7) {
    	console.log('/newclassrooms/\tcomponents/\tcomponent_contact_form/\tcontact-form.js', 'constructor()');

        this.$cf7 = $cf7
        this.$interestsCheckboxes = $cf7.find('[name="interested-in[]"]')
        this.$rolesDropdown = $cf7.find('[name="role"]')
    }

    init() {
    	console.log('/newclassrooms/\tcomponents/\tcomponent_contact_form/\tcontact-form.js', 'init()');

        this.bindEvents()
        // this.prefillRoles()
        this.prefillInterests()
    }

    bindEvents() {
    	console.log('/newclassrooms/\tcomponents/\tcomponent_contact_form/\tcontact-form.js', 'bindEvents(), this.$interestsCheckboxes: this:', this.$interestsCheckboxes, this);

        this.$interestsCheckboxes.each((index, checkbox) => {
        	console.log('/newclassrooms/\tcomponents/\tcomponent_contact_form/\tcontact-form.js › checkbox, index: checkbox: ', index, checkbox);

        	$(checkbox).change(this.syncHiddenInputs)
        })
    }

    syncHiddenInputs(ev) {
    	console.log('/newclassrooms/\tcomponents/\tcomponent_contact_form/\tcontact-form.js', 'syncHiddenInputs(ev:)', ev);

        const $checkbox = $(ev.currentTarget)

        // Slugify the selected value
        const chosenInterest = $checkbox.val().toString().toLowerCase()
            .replace(/\//g, '-')
            .replace(/\s+/g, '-')
            .trim()

        const $input = $(`input.hidden.${chosenInterest}`)

        // Set the new interest to true
        if ($input.length && $checkbox.is(':checked')) {
            $input.val('true')
        } else {
            $input.val('false')
        }
    }

    prefillRoles() {
    	console.log('/newclassrooms/\tcomponents/\tcomponent_contact_form/\tcontact-form.js', 'prefillRoles()');

        const urlParams = new URLSearchParams(location.search)
        const role = urlParams.get('role')
        const hasRole = this.$rolesDropdown.find(`option:contains("${role}")`).length > 0

        if (role && hasRole) {
            this.$rolesDropdown.val(role)
        }
    }

    prefillInterests() {
    	console.log('/newclassrooms/\tcomponents/\tcomponent_contact_form/\tcontact-form.js', 'prefillInterests()');

        const urlParams = new URLSearchParams(location.search)
        const interest = urlParams.get('int')

        this.$interestsCheckboxes.each(function (index, checkbox) {
            if (!FLEX.isUndefinedOrNull(interest) && interest.hasOwnProperty('toLowerCase') && checkbox.value.toLowerCase() === interest.toLowerCase()) {
                checkbox.checked = true;
                $(checkbox).change();
            }
        })
    }
}

const init = function () {
	console.log('/newclassrooms/\tcomponents/\tcomponent_contact_form/\tcontact-form.js', 'init()');
    const $cf7 = $('.component-contact-form.component')

    if ($cf7.length) {
        const contactForm = new ContactForm($cf7)
        contactForm.init()
    }
}

export default init
