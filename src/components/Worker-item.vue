<template>

<div @click="activeWorker">
    <p class="worker-item__name">{{ product_data.first_name }}</p>
    <!-- <p class="worker-item__surname">{{ product_data.surname }}</p> -->
    <p class="worker-item__age">{{ product_data.last_name }}</p>
    <p class="worker-item__age">{{ product_data.age }}</p>
    <p class="worker-item__age">{{ product_data.position }}</p>
    <p class="worker-item__age">{{ product_data.remote_work }}</p>
    <p class="worker-item__age">{{ product_data.address }}</p>
</div>

</template>

<script>
export default {
    props: {
      product_data: {
        type: Object,
        default() {
          return {}
        }
      },
    },
    methods: {
      activeWorker() {
        this.$emit('sendActiveUp', this.product_data.id);
      },
    }
}
</script>

<style>



.price__element:first-child {
    border-top: 3px solid red; 
}

.price__element:last-child {
    border-bottom: 1px solid #B6BBC2;
}




.worker-item {
  display: flex;
  padding: 20px;
}

.worker-item__name,
.worker-item__surname,
.worker-item__age {
  padding-left: 15px;
}

.worker-item__btn {
    margin-left: 15px;
}



</style>