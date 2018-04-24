<template>
    <div class="notification pos-top pos-right search-box bg--white border--bottom" data-animation="from-top" data-notification-link="search-box">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8">
                <input type="search" v-model="keyword" @keypress.enter="search()" placeholder="Type search query and hit enter" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                keyword: '',
            }
        },
        methods: {
            search () {
                if (this.keyword == '') {
                    return;
                }
                axios.post('/search', {keyword: this.keyword}).then(({data}) => {
                    Event.fire('search-results', data.posts);
                });
            }
        }
    }
</script>
