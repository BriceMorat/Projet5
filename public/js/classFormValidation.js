class FormValidation {
    constructor() {
        this.pseudoInput = document.getElementById('pseudo');
        this.pswInput = document.getElementById('psw');
        this.pswConfirmInput = document.getElementById('psw_confirm');
        this.emailInput = document.getElementById('email');

        this.titleInput = document.getElementById('title');
        this.countryInput = document.getElementById('country');
        this.postContentInput = document.getElementById('textarea_ifr');
        this.filesInput = document.getElementById('files');
        this.alert = document.getElementById('alert');

        this.commentContentInput = document.getElementById('comment');
        this.submitForm = document.getElementById('submitForm');
    }
    
// Form validation data

    submitRegistrationForm() {

        this.submitForm.addEventListener('click', e => {
        
            if (this.pseudoInput.value === '' || this.pswInput.value === '' || this.pswConfirmInput.value === '' || this.emailInput.value === '') {
                e.preventDefault();

                this.pseudoInput.style.border = 'dotted #FF0000';
                this.pseudoInput.value = 'Veuillez saisir un pseudo';
                this.pseudoInput.style.color = '#FF0000';

                this.pswInput.style.border = 'dotted #FF0000';
                this.pswInput.type = 'text';
                this.pswInput.value = 'Veuillez saisir un mot de passe';
                this.pswInput.style.color = '#FF0000';

                this.pswConfirmInput.style.border = 'dotted #FF0000';
                this.pswConfirmInput.type = 'text';
                this.pswConfirmInput.value = 'Veuillez saisir un mot de passe';
                this.pswConfirmInput.style.color = '#FF0000';

                this.emailInput.style.border = 'dotted #FF0000';
                this.emailInput.value = 'Veuillez saisir une adresse email';
                this.emailInput.style.color = '#FF0000';
            }
        })

        this.pseudoInput.addEventListener('input', e => {
            this.pseudoInput.style.border = 'none'; 
            this.pseudoInput.style.color = 'initial'; 
        })

        this.pswInput.addEventListener('input', e => {
            this.pswInput.type = 'password';
            this.pswInput.style.border = 'none'; 
            this.pswInput.style.color = 'initial'; 
        })

        this.pswConfirmInput.addEventListener('input', e => {
            this.pswConfirmInput.type = 'password';
            this.pswConfirmInput.style.border = 'none'; 
            this.pswConfirmInput.style.color = 'initial'; 
        })

        this.emailInput.addEventListener('input', e => {
            this.emailInput.style.border = 'none'; 
            this.emailInput.style.color = 'initial'; 
        })
    }

    submitLoginForm() {

        this.submitForm.addEventListener('click', e => {

            if (this.pseudoInput.value === '' || this.pswInput.value === '') {
            
                e.preventDefault();
                this.pseudoInput.style.border = 'dotted #FF0000';
                this.pseudoInput.value = 'Veuillez saisir un pseudo';
                this.pseudoInput.style.color = '#FF0000';

                this.pswInput.style.border = 'dotted #FF0000';
                this.pswInput.type = 'text';
                this.pswInput.value = 'Veuillez saisir un mot de passe';
                this.pswInput.style.color = '#FF0000';
            }
        })

        this.pseudoInput.addEventListener('input', e => {
            this.pseudoInput.style.border = 'none'; 
            this.pseudoInput.style.color = 'initial'; 
        })

        this.pswInput.addEventListener('input', e => {
            this.pswInput.type = 'password';
            this.pswInput.style.border = 'none'; 
            this.pswInput.style.color = 'initial'; 
        })
    }

    submitPostForm() {

        this.submitForm.addEventListener('click', e => {

            if (this.titleInput.value === '' || this.titleInput.value === 'Veuillez saisir un titre' || this.countryInput.value === '' 
            || this.countryInput.value === 'Veuillez saisir un nom de Pays' || this.cityInputText.value === '' 
            || this.cityInputText.value === 'Veuillez rechercher un nom d\'endroit' || this.filesInput.files.length === 0) {
                
                e.preventDefault();
                this.titleInput.style.border = 'dotted #FF0000';
                this.titleInput.value = 'Veuillez saisir un titre';
                this.titleInput.style.color = '#FF0000';

                this.countryInput.style.border = 'dotted #FF0000';
                this.countryInput.value = 'Veuillez saisir un nom de Pays';
                this.countryInput.style.color = '#FF0000';

                this.filesInput.style.border = 'dotted #FF0000';
                this.alert.style.display = 'block';
                this.alert.style.color = '#FF0000';
            } 
        })

        this.titleInput.addEventListener('input', e => {
            this.titleInput.style.border = 'none'; 
            this.titleInput.style.color = 'initial'; 
        })

        this.countryInput.addEventListener('input', e => {
            this.countryInput.style.border = 'none'; 
            this.countryInput.style.color = 'initial';
        })

        this.filesInput.addEventListener('input', e => {
            this.filesInput.style.border = 'none'; 
            this.filesInput.style.color = 'initial';
            this.alert.style.display = 'none';
        })

    }

    submitUpdatePostForm() {

        this.submitForm.addEventListener('click', e => {

            if (this.titleInput.value === '' || this.titleInput.value === 'Veuillez saisir un titre' || this.filesInput.files.length === 0) {
                e.preventDefault();
                this.titleInput.style.border = 'dotted #FF0000';
                this.titleInput.value = 'Veuillez saisir un titre';
                this.titleInput.style.color = '#FF0000';

                this.filesInput.style.border = 'dotted #FF0000';
                this.alert.style.display = 'block';
                this.alert.style.color = '#FF0000';
            } 
        })

        this.titleInput.addEventListener('input', e => {
            this.titleInput.style.border = 'none'; 
            this.titleInput.style.color = 'initial'; 
        })

        this.filesInput.addEventListener('input', e => {
            this.filesInput.style.border = 'none'; 
            this.filesInput.style.color = 'initial';
            this.alert.style.display = 'none';
        })

    }

    submitCommentForm() {

        this.submitForm.addEventListener('click', e => {

            if (this.commentContentInput.value === '' || this.commentContentInput.value === 'Veuillez saisir un contenu') {
                e.preventDefault();
                this.commentContentInput.style.border = 'dotted #FF0000';
                this.commentContentInput.value = 'Veuillez saisir un contenu';
                this.commentContentInput.style.color = '#FF0000';
            } 
        })

        this.commentContentInput.addEventListener('input', e => {
            this.commentContentInput.style.border = 'none'; 
            this.commentContentInput.style.color = 'initial';
        })
    }
}


