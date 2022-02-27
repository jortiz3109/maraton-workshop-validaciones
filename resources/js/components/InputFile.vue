<template>
    <div class="card-body">
        <div class="mb-3" v-for="field in fields" :key="field">
            <input type="file" :class="cssClasses()" :name="inputFieldName()" required>
            <slot></slot>
        </div>
    </div>
</template>
<script>
export default {
    name: 'InputFile',
    data: () => ({
            fields: 1
    }),
    props: {
        fieldName: {
            required: true,
            type: String
        },
        maxImages: {
            type: Number,
            default: 5
        },
        cssClass: {
            type: String,
            default: ''
        }
    },
    methods: {
        addField() {
            if (this.fields < this.maxImages) {
                this.fields++;
            }
        },
        removeField() {
            if (this.fields > 1) {
                this.fields--;
            }
        },
        removeAllFields() {
            this.fields = 1;
        },
        inputFieldName() {
            return this.fieldName.concat('[]');
        },
        cssClasses() {
            return "form-control ".concat(this.cssClass).trim();
        }
    },
    mounted() {
        this.$root.$on('add-image', () => {
            this.addField();
        })

        this.$root.$on('remove-image', () => {
            this.removeField();
        })

        this.$root.$on('remove-all-images', () => {
            this.removeAllFields();
        })
    },
}
</script>
