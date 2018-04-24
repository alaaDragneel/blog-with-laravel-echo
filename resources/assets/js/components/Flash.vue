<template>
    <div class="alert alert-dismissible alert-flash" :class="'alert-' + level" role="alert" v-show="show">
        <strong v-if="isLink">
            <a :href="link" class="alert-link" v-text="body"></a>
        </strong>
        <p v-text="body" v-else></p>
    </div>
</template>

<script>
    export default {
        props: ['message', 'user_id'],
        data() {
            return {
                body: this.message,
                level: 'success',
                show: false,
                isLink: false,
                link: '#'
            };
        },
        created() {
            if (this.message) {
                this.flash();
            }
            Event.listen('flash', data => this.flash(data));
        },
        mounted() {
        	this.webSocketInit();
        },
        methods: {
            flash(data) {
                if (data) {
                    this.body = data.message;
                    this.level = data.level;
                }
                this.show = true;

                this.hide();
            },
            hide() {
                setTimeout(() => {
                    this.show = false;
                }, 7000);
            },
            webSocketInit() {
                const self = this;
            	Echo.channel('new-post-added')
            		.listen('SendNotificationsForSubscripers', (tag) => {
                        if (tag.subscriptionsIds.includes(this.user_id)) {
                            this.isLink = true;
                            this.link = `/post/${tag.new_post_name}`
                            flash(`New Post Was Added For Tag: ${tag.name}`);
                        }
            		});
            }
        }
    }
</script>

<style>
    .alert-flash {
        position: fixed;
        right: 25px;
        top: 25px;
    }
</style>
