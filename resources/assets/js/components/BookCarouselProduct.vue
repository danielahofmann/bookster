<template>
    <div class="grid-x flex-center">
            <a :href="route(product, this.id)" class="cell small-11 product-container grid-x">
                <div class="product-image cell small-5">
                    <img :src="productImage + img" alt="Produktbild">
                </div>
                <div class="product-details cell small-7">
                    <p class="title" :style="{ fontSize: fontSizeTitle }">{{ bookTitle }}</p>
                    <p class="author" :style="{ fontSize: fontSizeAuthor }">{{ authorFirstname }} {{ authorLastname }}</p>
                    <p class="price" :style="{ fontSize: fontSizePrice }">{{ price }} €</p>
                </div>
            </a>
        </div>
</template>

<script>
    export default {
        data() {
            return {
                fontSizeTitle: null,
                fontSizeAuthor: null,
                fontSizePrice: null,
            }
        },
        mounted() {
            window.addEventListener('resize', this.getWindowWidth);

            this.getWindowWidth();
        },
        computed: {
            product() {
                return this.$store.state.product;
            },
            productImage() {
                return this.$store.state.productImage;
            },
        },
        methods: {
            getWindowWidth: function() {
                this.windowWidth = document.documentElement.clientWidth;

                //Desktop Size
                if (this.windowWidth > 1024){
                    this.fontSizeTitle = this.desktopTitle + "rem";
                    this.fontSizeAuthor = this.desktopAuthor + "rem";
                    this.fontSizePrice = this.desktopPrice + "rem";
                }

                //Tablet
                if (this.windowWidth < 1024){
                    this.fontSizeTitle = this.tabletTitle + "rem";
                    this.fontSizeAuthor = this.tabletAuthor + "rem";
                    this.fontSizePrice = this.tabletPrice + "rem";
                }

                //Mobile
                if (this.windowWidth < 640){
                    this.fontSizeTitle = this.mobileTitle + "rem";
                    this.fontSizeAuthor = this.mobileAuthor + "rem";
                    this.fontSizePrice = this.mobilePrice + "rem";
                }
            },
        },
        beforeDestroy() {
            window.removeEventListener('resize', this.getWindowWidth);
        },
        props: ['bookTitle', 'price', 'authorFirstname', 'authorLastname', 'desktopTitle', 'desktopAuthor', 'desktopPrice',
            'mobileTitle', 'tabletTitle', 'mobileAuthor', 'tabletAuthor', 'mobilePrice', 'tabletPrice', 'img', 'id'],
    }
</script>

<style lang="scss" scoped>
    @import '~@/app.scss';

    .product-container{
        background-color: $beige;
        border-radius: 15px;
        padding: 40px 25px;
        height: 275px;
        overflow: hidden;

        &:hover{
            background-color: $dark-beige;
        }

        @include custom-max(700px){
            height: auto;
        }

        @include custom-min(1400px){
            height: 290px;
        }

        .product-image{
            overflow: hidden;

            img{
                object-fit: contain;
                height: 100%;

                @include custom-max(699px){
                    height: auto;
                }
            }
        }

        .product-details{
            padding-left: 20px;

            .title{
                @include text-styling($primary-font, $bold, 1.2rem);
                @include custom-min(1300px){
                    margin-top: 1rem;
                    margin-bottom: 0;

                }
                color: $dark-grey;
            }

            .author{
                @include text-styling($secondary-font, $regular, 1rem);
                color: $dark-grey;

            }

            .price{
                @include text-styling($secondary-font, $semibold, 1rem);
                @include custom-min(1400px){
                    margin-top: 1.5rem;

                }
                color: $dark-grey;

            }
        }
    }
</style>