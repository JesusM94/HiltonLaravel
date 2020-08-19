<template>
    <div class="app">
        <header>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">Example Component</div>

                            <div class="card-body">
                                I'm an example component.
                                <ul class="list-unstyled">
                                    <li>
                                        <router-link class="nav-link" :to="{name: 'l-nuevo'}">Lo Nuevo</router-link>
                                    </li>
                                    <li>
                                        <router-link class="nav-link" :to="{name: 'l-dama'}">Dama</router-link>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <main role="main" class="inner cover">
            <router-view></router-view>
        </main>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
