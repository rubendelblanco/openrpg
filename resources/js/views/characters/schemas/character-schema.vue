<script>
    import VueFormGenerator from 'vue-form-generator'

    export default {
        fields: [
            {
                type: 'input',
                inputType: 'text',
                label: 'Name',
                model: 'name',
                placeholder: 'Character name',
                featured: true,
                required: true
            },
            {
                type: 'input',
                inputType: 'number',
                label: 'Experience',
                model: 'experience',
                placeholder: 'Experience points'
            },
            {
                type: 'input',
                inputType: 'number',
                label: 'Level',
                model: 'Level',
                required: true
            }
        ]
    };
</script>