<template>
    <div class="small-12 text-center">
        <a href="/" class="opt-out">Zurück zur Altersauswahl</a>
    </div>
</template>

<script>
    export default {
        data() {
            return {}
        },
        mounted() {},
    }
</script>

<style lang="scss" scoped>
    @import '~@/app.scss';

    div{
        background: $beige;
        padding: 20px 0;

        a{
            color: $light-grey;
            @include text-styling($primary-font, $light, 12px);
            text-align: center;

            &:hover{
                color: $dark-grey;
                font-weight: $regular;
            }
        }
    }

</style>