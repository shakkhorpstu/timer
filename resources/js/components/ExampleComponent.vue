<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <span class="float-right clock" style="font-family: 'Share Tech Mono', monospace;">{{ minute < 10 ? '0'+minute : minute }}m {{ second < 10 ? '0'+second : second }}s</span>
                    </div>

                    <div class="card-body">
                        I'm an example component.
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return {
            totalTime: 0,
            hour: 0,
            minute: 0,
            second: 0,
            duration: 1
        }
    },
    methods: {
        countdown: function() {
          this.totalTime--;
        },
        log: function(){
            this.totalTime = this.totalTime;
            this.minute = Math.floor(this.totalTime / 60);

            if(this.second == 0){
                this.second = 59;
                this.minute -= 1;
            }
            else{
                this.second = this.second - 1;
            }

            if(this.totalTime == 0){
                this.totalTime = '';
                // this.submit();
                // alert("Time's up.\nRedirecting...");
            }
        }
    },
    mounted() {
        this.minute = this.duration;
        this.totalTime = this.duration * 60;
        this.second = 0;

    },
    computed: {
        reduceTime: function(){
          this.timer = setInterval(() => this.countdown(), 1000);
        }
    },
    created(){
        this.$options.interval = setInterval(this.log, 1000);
        this.reduceTime;
    }

}
</script>
