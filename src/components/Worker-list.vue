<template>
<div class="worker-list">
    <!-- <button @click="addNewWorker">Добавить колонку</button> -->
    <Worker-item class="worker-item__element"
        v-for="worker in workers" 
        :key="worker.id"
        :product_data="worker"
        @sendActiveUp="getActiveWorker"
        :class="{'active': worker.id === activeUser}"
        ></Worker-item>
</div>
</template>

<script>
import WorkerItem from './Worker-item'


// const HTTP = axios.create({
//   headers: {
//     'Content-Type': 'application/json',
//     'Access-Control-Allow-Origin': '*'
//   },
//   xsrfHeaderName: 'Csrf-Token',
//   withCredentials: true,
// })

export default {
    data() {
        return {


            // url: "http://localhost:8080",
            postName: "",
            postSurname: "",
            postAge: "",
            activeUser: "1",
            
        }
    },
    props: {
      workers: {
        type: Array,
        default() {
          return []
        }
      }
    },

    components: {
        WorkerItem
    },
    methods: {
        getActiveWorker(id) {
            this.activeUser = id;
            this.$emit('sendActiveUp', this.activeUser);
        },
        // activeWorker() {

        // },
    }

}
</script>

<style>

.active {
    background: #99a;
}

.worker-item__element {
    width: 100%;
    min-height: 50px;
    border: 1px solid transparent;
    border-bottom: 1px solid #B6BBC2;
    box-sizing: border-box;
    display: grid;
    grid-template-columns: minmax(auto, 100px) minmax(auto, 180px) minmax(auto, 150px) minmax(auto, 210px) minmax(auto, 200px) minmax(auto, 290px);
    padding-left: 30px;    
    align-items: center;
    cursor: pointer;
}

.worker-item__element:hover {
    background: #E7EEDE;
}



</style>