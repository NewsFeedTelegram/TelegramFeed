<template>
    <header>
        <div class="container-fluid">
            <div class="row no-gutters bg-wrapper">
                <div class="col d-none d-sm-none d-md-block">
                    <div class="bg">
                        <div class="offset-md-1">
                            <a href="#" class="logo"><img src="img/logo.png" alt="Beautifullife"></a>
                        </div>
                        <div class="row slogan_wrapper">
                            <div class="col-md-11 offset-md-1">
                                <h1 class="slogan--text">
                                    all news <br>
                                    on one <br>
                                    site
                                </h1>
                                <a href="#" class="btn btn-transparent" @click.prevent="register=!register">Register Now</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 col-lg-4 col-xl-4">
                    <div class="bg2">
                        <div class="header col-md-12 d-sm-flex d-md-none">
                            <a href="#" class="logo"><img src="img/logo_dark.png" alt="Beautifullife"></a>
                            <a href="#" class="btn btn-transparent " @click.prevent="register=!register">Register Now</a>
                        </div>
                        <form v-if="register">
                            <h2>Login to your Account</h2>
                            <div class="form-group">
                                <input type="email" class="form-control field" aria-describedby="emailHelp"
                                       placeholder="Enter email">
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control field" aria-describedby="PasswordHelp"
                                       placeholder="Enter password">
                            </div>
                            <div class="remember">
                                <div class="form-group">
                                    <label class="container">Remember Me
                                        <input type="checkbox">
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <a href="#">Forgot my Password</a>
                            </div>
                            <button class="btn">
                                <svg
                                        version="1.1"
                                        id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 490.4 490.4" style="enable-background:new 0 0 490.4 490.4; fill:#50bfa4" xml:space="preserve">
                                        <path d="M245.2,490.4c135.2,0,245.2-110,245.2-245.2S380.4,0,245.2,0S0,110,0,245.2S110,490.4,245.2,490.4z M245.2,24.5
                                            c121.7,0,220.7,99,220.7,220.7s-99,220.7-220.7,220.7s-220.7-99-220.7-220.7S123.5,24.5,245.2,24.5z"/>
                                        <path d="M138.7,257.5h183.4l-48,48c-4.8,4.8-4.8,12.5,0,17.3c2.4,2.4,5.5,3.6,8.7,3.6s6.3-1.2,8.7-3.6l68.9-68.9
                                            c4.8-4.8,4.8-12.5,0-17.3l-68.9-68.9c-4.8-4.8-12.5-4.8-17.3,0s-4.8,12.5,0,17.3l48,48H138.7c-6.8,0-12.3,5.5-12.3,12.3
                                            C126.4,252.1,131.9,257.5,138.7,257.5z"/>
                                </svg>
                            </button>
                            <p>Don’t you have an account? <a href="" @click.prevent="register=!register">Register Now!</a> it’s realy simple
                                and you can start enjoing all the benefits! </p>

                        </form>
                        <form v-else>
                            <h2>Register to Beautifullife</h2>
                            <div class="form-group">
                                <input type="text" class="form-control field"
                                       placeholder="Enter login">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control field" aria-describedby="emailHelp"
                                       placeholder="First name">
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control field" aria-describedby="PasswordHelp"
                                       placeholder="Last name">
                            </div>
                            <button class="btn">
                                <svg
                                        version="1.1"
                                        id="Capa_1"
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                        viewBox="0 0 490.4 490.4" style="enable-background:new 0 0 490.4 490.4; fill:#50bfa4" xml:space="preserve">
                                        <path d="M245.2,490.4c135.2,0,245.2-110,245.2-245.2S380.4,0,245.2,0S0,110,0,245.2S110,490.4,245.2,490.4z M245.2,24.5
                                            c121.7,0,220.7,99,220.7,220.7s-99,220.7-220.7,220.7s-220.7-99-220.7-220.7S123.5,24.5,245.2,24.5z"/>
                                        <path d="M138.7,257.5h183.4l-48,48c-4.8,4.8-4.8,12.5,0,17.3c2.4,2.4,5.5,3.6,8.7,3.6s6.3-1.2,8.7-3.6l68.9-68.9
                                            c4.8-4.8,4.8-12.5,0-17.3l-68.9-68.9c-4.8-4.8-12.5-4.8-17.3,0s-4.8,12.5,0,17.3l48,48H138.7c-6.8,0-12.3,5.5-12.3,12.3
                                            C126.4,252.1,131.9,257.5,138.7,257.5z"/>
                                </svg>
                            </button>
                            <p>Don’t you have an account? <a href="#" @click.prevent="register=!register">Login Now!</a> it’s realy simple
                                and you can start enjoing all the benefits! </p>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
    export default {
        data () {
            return {
                register: true
            }
        },
        mounted() {
            console.log('Герцун Пидар ')
        }
    }
</script>
