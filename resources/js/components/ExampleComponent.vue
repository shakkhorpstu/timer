<template>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="card">
					<div class="card-header">
						<span class="float-right clock" style="font-family: 'Share Tech Mono', monospace;">{{ minute < 10 ? '0'+minute : minute }}m {{ second < 10 ? '0'+second : second }}s</span>
					</div>

					<div class="card-body">
						<div class="form-group" v-for="(item, index) in data">
							<h4>{{ index + 1 }} {{ item.name }}</h4>
							<span class="" v-for="(option, op_index) in item.options">
								<input type="radio" @change="push(index+1, item.id, option, 11)" v-model="optionValue[item.id]" :value="item.id+'_'+op_index">{{ ' '+option+'&nbsp; ' }}
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
export default {
	props: ['data'],
	data(){
		return {
			totalTime: 0,
			hour: 0,
			minute: 0,
			second: 0,
			duration: 1,
            // items: [
            // 	{id: 1, name: 'Potato', options: ['op1', 'op2', 'op3']},
            // 	{id: 1, name: 'Cucumber' options: ['op4', 'op5', 'op6']},
            // 	{id: 1, name: 'Brinjal', options: ['op7', 'op8', 'op9']},
            // 	{id: 1, name: 'Finger', options: ['op10', 'op11', 'op12']}
            // ],
            item_id: '',
            optionValue: [],
            questionanswers: [
            {
                question_id: '',
                index: '',
                answer_option: ''
            }
            ],
            answer: [
            {
                id: '',
                answered: '',
            }
            ],
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
        },
        push: function(questionIndex, questionId, givenAnswer, correctAnswer){
        	if(this.answer.length > 1){
        		for(var i=1; i<=this.answer.length; i++){
        			if(this.answer[i]){
        				if(this.answer[i].id == questionId && this.answer[i].answered != givenAnswer){
        					this.answer[i].answered = givenAnswer;
        					this.replaceToTotal(questionId, questionIndex, givenAnswer);
        					if(givenAnswer == correctAnswer){
        						this.right += 1;
        					}
        					else{
        						this.right -= 1;
        					}

        					break;
        				}
        			}
        			else{
        				if(this.answer.length == i){
        					this.answer.push({id: questionId, answered: givenAnswer});
        					this.pushToTotal(questionId, questionIndex, givenAnswer);
        					if(givenAnswer == correctAnswer){
        						this.right += 1;
        					}
        					break;
        				}
        			}

        		}
        	}
        	else{
        		this.answer.push({id: questionId, answered: givenAnswer});
        		this.pushToTotal(questionId, questionIndex, givenAnswer);
        		if(givenAnswer == correctAnswer){
        			this.right += 1;
        		}
        	}
        },
        replaceToTotal: function(question_id, index, option){
        	for(var i=1; i<=this.questionanswers.length; i++){
        		if(this.questionanswers[i]){
        			if(this.questionanswers[i].question_id == question_id){
        				this.questionanswers[i].answer_option = option;
        			}
        		}
        	}
        },
        pushToTotal: function(question_id, index, option){
        	this.questionanswers.push({question_id: question_id,index: index, answer_option: option});
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
