<template>
    <header id="header" class="header-page">
        <div class="header-page--logo">
            <a href="#">
                <img src="img/logo-mini.png" alt="" class="header-page--logo-img">
            </a>
        </div>
        <div class="header-page--pagename">
            <p class="header-page--pagename-text">{{titlePage}}</p>
        </div>
        <div class="header-page-content-wrapper">
            <form class="header-page--search">
                <input type="text" class="header-page--search-input"
                       placeholder="Search here people">
                <button>
                    <svg class="icon icon-magnifier-tool">
                        <use xlink:href="#icon-magnifier-tool"></use>
                    </svg>
                </button>
            </form>
            <div class="header-page--navmenu">
                <ul class="header-page--navmenu--items">
                    <li class="header-page--navmenu-item">
                        <a href="#">
                            <svg class="icon icon-newspaper">
                                <use xlink:href="#icon-newspaper"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="header-page--navmenu-item">
                        <a href="#">
                            <svg class="icon icon-bookmark-white">
                                <use xlink:href="#icon-bookmark-white"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="header-page--navmenu-item">
                        <a href="#">
                            <svg class="icon icon-envelope">
                                <use xlink:href="#icon-envelope"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="header-page--navmenu-item">
                        <a href="#">
                            <svg class="icon icon-alarm">
                                <use xlink:href="#icon-alarm"></use>
                            </svg>
                        </a>
                        <span class="header-page--navmenu-item-notify"></span>
                    </li>
                    <li class="header-page--navmenu-item">
                        <a href="#">
                            <svg class="icon icon-more-button">
                                <use xlink:href="#icon-more-button"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
                <div class="header-page--dropdown" @click.stop="toggleDropdown" :class="{active}">
                    <div class="header-page--dropdown-wrapper">
                        <span class="header-page--dropdown-username">{{userFullName}}</span>
                        <span class="header-page--dropdown-useravatar">
                            <img src="img/bg.jpg" alt="">
                        </span>
                        <svg class="icon icon-down-arrow">
                            <use xlink:href="#icon-down-arrow"></use>
                        </svg>
                    </div>
                    <transition name="fade">
                        <ul class="header-page--dropdown-menu" v-show="active">
                            <li><a href="#">Моя страница</a></li>
                            <li><a href="/logout" @click.prevent="logout">Выйти</a></li>
                        </ul>
                    </transition>
                </div>

            </div>
        </div>
    </header>
</template>

<script>
    export default {
        name: "Header",
        data() {
            return {
                active: false
            }
        },
        methods: {
            toggleDropdown() {
                this.active = !this.active
            },
            logout() {
                this.$store.dispatch('AUTH_LOGOUT')
                this.$router.replace('/')
            }

        },
        computed: {
            titlePage() {
                return this.$route.meta.title
            },
            userFullName(){
                return `${this.$store.getters.user.first_name} ${this.$store.getters.user.last_name}`
            }
        },
        mounted() {
            window.addEventListener('click', e => {
                if (e.target.parentNode.classList !== 'header-page--dropdown') {
                    this.active = false
                }
            })
        },
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: all .3s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */
    {
        opacity: 0;
    }
</style>