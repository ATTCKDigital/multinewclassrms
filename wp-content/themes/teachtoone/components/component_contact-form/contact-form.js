import $ from 'jquery'

class ContactForm {

    constructor($cf7) {
        this.$cf7 = $cf7
        this.$interestsCheckboxes = $cf7.find('[name="interested-in[]"]')
        this.$rolesDropdown = $cf7.find('[name="role"]')
    }

    init() {
        this.bindEvents()
        this.prefillRoles()
        this.prefillInterests()
    }

    bindEvents() {
        this.$interestsCheckboxes.each((index, checkbox) => {
            $(checkbox).change(this.syncHiddenInputs)
        })
    }

    syncHiddenInputs(ev) {
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
        const urlParams = new URLSearchParams(location.search)

        const role = urlParams.get('role')
        const hasRole = this.$rolesDropdown.find(`option:contains("${role}")`).length > 0

        if (role && hasRole) {
            this.$rolesDropdown.val(role)
        }
    }

    prefillInterests() {
        const urlParams = new URLSearchParams(location.search)

        const interest = urlParams.get('int')

        this.$interestsCheckboxes.each(function(index, checkbox) {

            if(checkbox.value.toLowerCase() === interest.toLowerCase()) {
                checkbox.checked = true
                $(checkbox).change()
            }
        })
    }
}


const init = function() {

    const $cf7 = $('.component-contact-form.component')

    if ($cf7.length) {
        const contactForm = new ContactForm($cf7)
        contactForm.init()
    }
}


export default init
