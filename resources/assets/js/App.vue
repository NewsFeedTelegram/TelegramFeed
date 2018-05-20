<template>
    <div>
        <div>
            <transition name="fade">
                <app-header v-if="!isIndex"></app-header>
            </transition>

            <transition name="fade">
                <router-view></router-view>
            </transition>
        </div>
    </div>
</template>

<script>
    import AppHeader from './components/Authorized/Header'

    export default {
        name: "App",
        components: {
            AppHeader
        },
        mounted() {
            if (this.$store.getters.isAuthenticated) {
                this.$store.dispatch('USER_PROFILE')
                    .catch(() => {
                        this.$store.dispatch('AUTH_LOGOUT')
                        this.$router.replace('/')
                    })
            }
        },
        computed: {
            isIndex() {
                return this.$route.name === 'Index' ? true : false
            }
        }
    }
</script>

<style scoped>
    .fade-enter-active, .fade-leave-active {
        transition: opacity .5s;
    }

    .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */
    {
        opacity: 0;
    }
</style>