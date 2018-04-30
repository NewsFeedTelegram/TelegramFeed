<template>
    <div>
        HELLO {{user.first_name}} {{user.last_name}}
        <a href="#" @click.prevent="logout"> LOGOUT </a>
    </div>
</template>

<script>
    export default {
        name: "Test",
        computed: {
            user() {
                console.log(this.$store.getters.user)
                return this.$store.getters.user
            }
        },
        methods: {
            logout() {
                this.$store.dispatch('AUTH_LOGOUT')
                this.$router.replace({name: 'Index'})
            }
        }
    }
</script>

<style scoped>

</style>