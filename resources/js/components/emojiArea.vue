<template>
    <div>
        <textareas class="emoji-editor"></textareas>
    </div>
</template>

<script>

    var _ = require('lodash');

    import emoji from './emojiArea.vue';

    export default {
        data(){
            return{
            }
        },
        name: 'emoji',
        props: [
        ],
        components: {
            'emoji': emoji
        },
        mounted() {
            this.$nextTick(function() {

                    $(".emoji-editor").emojioneArea({
                        attributes: {
                            dir: "rtl",
                            autocomplete: false,
                        }
                    });
            });
        },
        methods: {

        }

    }
</script>
