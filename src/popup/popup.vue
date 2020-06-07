<template>
<div class="popup">
    <div class="popup-header">
        <slot name="header">Заголовок по умолчанию</slot>
    </div>
    <div class="popup-content">
        <slot></slot>
    </div>
    <div class="popup-footer">
        <slot name="footer">Добавить</slot>
        <div @click="closePopup" class="popup-footer__btn button">Закрыть</div>
    </div>
</div>
</template>

<script>
export default {
    name: "popup",
    data() {
        return {
            
        }
    },
    methods: {
        closePopup() {
            this.$emit('closePopup');
        }
    }
    
}
</script>

<style>
.popup {
    padding: 16px;
    position: fixed;
    top: 25px;
    width: 600px;
    background: #fff;
    box-shadow: 0 0 17px 0 #e7e7e7;
    left: 50%;
    margin-left: -250px;
}

.popup-header {
    text-align: center;
    padding-bottom: 15px;
}

.popup-content {
    display: flex;
    justify-content: center;
    /* align-items: center; */
}

.popup-footer {
    display: flex;
    justify-content: space-evenly;
    margin-top: 20px;
}

/* .popup-footer__btn {
    padding: 8px;
    color: #fff;
    background: #212;
    width: 45px;
    cursor: pointer;
    margin-left: 5px;

} */

.button {
  color: #fff; /* цвет текста */
  text-decoration: none; /* убирать подчёркивание у ссылок */
  user-select: none; /* убирать выделение текста */
  background: rgb(212,75,56); /* фон кнопки */
  padding: .7em 1.5em; /* отступ от текста */
  outline: none; /* убирать контур в Mozilla */
  width: 70px;
  cursor: pointer;
  margin-left: 20px;
  /* margin-top: 20px; */
} 


</style>