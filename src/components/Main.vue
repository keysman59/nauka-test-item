<template>
  <div class="main">
    <!-- Добавление -->
    <popup v-if="isAddPopupVisible" @closePopup="closeAddPopup">
      <template>
        <h1 slot="header">Новый сотрудник</h1>
      </template>
      <template>
        <div class="main-form__left">
          <div class="main-form__wrap-image">
            <input type="file" id="file" ref="file" v-on:change="handleFileUpload()"/>
          </div>
        </div>
        <div class="main-form__right">
          <div class="main-form__column">
            <input v-model="first_name" placeholder="Введите имя" class="main-form__input" type="text" size="40">
            <input v-model="age" class="main-form__input" placeholder="Возраст" type="text" size="40">
            <input v-model="remote_work" class="main-form__input" placeholder="уд. работа" type="text" size="40">
          </div>
          <div class="main-form__column">
            <input v-model="last_name" placeholder="Введите фамилию" class="main-form__input" type="text" size="40">
            <input v-model="position" class="main-form__input" placeholder="должность" type="text" size="40">
            <input v-model="address" class="main-form__input" placeholder="Адрес" type="text" size="40"> 
          </div>
        </div>
      </template>
      <template>
        <div slot="footer" class="popup-footer__btn button" @click="addNewWorker">Добавить</div>
      </template>
    </popup>
    <!-- Редактирование -->
    <popup v-if="isEditPopupVisible" @closePopup="closeEditPopup">
      <template>
        <h1 slot="header">Редактировать сотрудника</h1>
      </template>
      <template>
        <div class="main-form__left">
          <div class="main-form__wrap-image">
            <img class="main-form__image" :src="dataUrlNew">
          </div>
        </div>
        <div class="main-form__right">
          <div class="main-form__column">
            <p class="main-form__text">Имя:</p>
            <input v-model="first_name" :placeholder="first_name" class="main-form__input" type="text" size="40">
            <p class="main-form__text">Возраст:</p>
            <input v-model="age" :placeholder="age" class="main-form__input" type="text" size="40">
            <p class="main-form__text">Удаленная работа:</p>
            <input v-model="remote_work" :placeholder="remote_work" class="main-form__input" type="text" size="40">
          </div>
          <div class="main-form__column">
            <p class="main-form__text">Фамилия:</p>
            <input v-model="last_name" :placeholder="last_name" class="main-form__input" type="text" size="40">
            <p class="main-form__text">Должность:</p>
            <input v-model="position" :placeholder="position" class="main-form__input" type="text" size="40">
            <p class="main-form__text">Адрес:</p>
            <input v-model="address" :placeholder="address" class="main-form__input" type="text" size="40"> 
          </div>
        </div>
      </template>
      <template>
        <div slot="footer" class="popup-footer__btn button button-w" @click="editWorker">Редактировать</div>
      </template>
    </popup>
    <!-- Удаление -->
    <popup v-if="isDelPopupVisible" @closePopup="closeDelPopup">
      <template>
        <h1 slot="header">Удалить сотрудника</h1>
      </template>
      <template>
        Вы действительно хотите удалить {{ first_name }} {{ last_name }} сотрудника?
      </template>
      <template>
        <div slot="footer" class="popup-footer__btn button button-w" @click="deleteWorker">Да</div>
      </template>
    </popup>
    <div class="buttons">
      <div class="button button1" @click="openAddPopup">Добавить</div>
      <div class="button button2" @click="openEditPopup">Редактировать</div>
      <div class="button button3"  @click="openDelPopup">Удалить</div>
    </div>

    <div class="worker-item__legend">
      <div class="table-caption__column">Имя</div>
      <div class="table-caption__column">Фамилия</div>
      <div class="table-caption__column">Возраст</div>
      <div class="table-caption__column">Должность</div>
      <div class="table-caption__column">Удаленная работа</div>
      <div class="table-caption__column">Адрес проживания</div>
    </div>
    <Worker-list :workers="sortedData" @sendActiveUp="getActiveWorker"></Worker-list>
  </div>
</template>

<script>
import popup from '../popup/popup'
import WorkerList from './Worker-list'
import axios from 'axios'

export default {
  name: 'Main',
  data() {
    return {
      dataImg: "",
      id: "29",
      activeUser: "1",
      results: [],
      sortedData: [],
      newArray: [],
      nearFirst_name: "",
      neraLast_name: "",
      forId: '',
      first_name: '', 
      last_name: '', 
      age: "",
      position: "",
      remote_work: "",
      address: "",
      isAddPopupVisible: false,
      isEditPopupVisible: false,
      isDelPopupVisible: false,
      activeUserObject: {},
      // name: "",
      file: "",

    myModel:false,
    // actionButton:'Insert',
    dynamicTitle:'Add Data',
    }
  },
  methods: {
    handleFileUpload(){
      this.file = this.$refs.file.files[0];
    },
    submitFile(){
      let formData = new FormData();
      formData.append('file', this.file);
      axios.post( 'http://test:81/action-image-upload.php',
        // axios.post( 'http://test:81/store.php',
        formData,
        {
        headers: {
            'Content-Type': 'multipart/form-data'
        }
      }).then(function(){
        console.log('SUCCESS!!');
      })
      .catch(function(){
        console.log('FAILURE!!');
      });
    },
    addNewWorker() {
      this.submitFile();
      axios.post('http://test:81/action.php', {
        action:'insert',
        firstName : this.first_name,
        lastName : this.last_name,
        age : this.age, 
        position : this.position,
        remoteWork : this.remote_work,
        address : this.address
      }).then((response) => {
        console.log(response);
        this.fetchAllData();
      })
      this.closeAddPopup();
    }, 
    editWorker() {
      axios.post('http://test:81/action.php', {
        action:'update',
        firstName : this.first_name,
        lastName : this.last_name,
        age : this.age, 
        position : this.position,
        remoteWork : this.remote_work,
        address : this.address,
        hiddenId : this.activeUser
      }).then((response) => {
        console.log(response);
        this.fetchAllData();
      })
      this.closeEditPopup();
    }, 
    deleteWorker() {
      axios.post('http://test:81/action.php', {
      action:'delete',
      id:this.activeUser
      }).then((response) => {
        console.log(response);
        this.fetchAllData();
      })
      this.closeDelPopup();
    },
    getActiveWorker(id) {
      this.activeUser = id;
    }, 
    openAddPopup() {
      this.first_name = "";
      this.last_name = "";
      this.age = ""; 
      this.position = "";
      this.remote_work = "";
      this.address = "";
      this.isAddPopupVisible = true;

    },
    closeAddPopup () {
      this.isAddPopupVisible = false;
    },
    openEditPopup() {
      this.submitImage();
      this.isEditPopupVisible = true;
      this.fetchAllData();
    },
    closeEditPopup () {
      this.isEditPopupVisible = false;
    },
    openDelPopup() {
      this.isDelPopupVisible = true;
      this.fetchAllData();
    },
    closeDelPopup () {
      this.isDelPopupVisible = false;
    },
    fetchAllData() {
      axios.post('http://test:81/action-get.php', {
        // action:'fetchall'
      }).then((response) => {
          console.log(response.data.users);
          this.filteredData(response.data.users);
          this.searchAcriveUser(response.data.users);
          this.first_name = this.activeUserObject.first_name;
          this.last_name = this.activeUserObject.last_name;
          this.age = this.activeUserObject.age;
          this.position = this.activeUserObject.position;
          this.remote_work = this.activeUserObject.remote_work;
          this.address = this.activeUserObject.address;
        });
    },
    filteredData(data) {
      this.sortedData = data.sort((a,b) => a.id-b.id)
    },
    searchAcriveUser(data) {
      this.activeUserObject = data.find(obj => {
        console.log(obj);
        if(obj.id == this.activeUser) {
          return obj;
        }
      });
      // console.log(this.activeUserObject);
    },
    submitImage() {
      axios.post( 'http://test:81/action-image-get.php', {
        // id: this.id   
        id: this.activeUser   
      }).then((response) => {
        this.dataImg = response.data;
      })
      .catch(function(){
        console.log('FAILURE!!');
      });
    },
  },
  computed: {
    changeActiveId() {
      return this.activeUser;
    },
    dataUrlNew() {
      return 'data:image/jpeg;base64,' + this.dataImg;
    },
  },
  created() {
    this.fetchAllData();
  },
  components: {
    popup,
    WorkerList
  }

}
</script>

<style scoped>

.main {
  padding-top: 15px;
}

.buttons {
  display: flex;
}

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
} 

.button-w {
  width: 110px;
}

.main-form {
  display: flex;
}

.main-form__left {
  display: flex;
  flex-direction: column;
  width: 36%;
  padding-right: 15px;
}

.main-form__right {
  display: flex;
  flex-direction: column;
  width: 58%;
}

.main-form__text {
  padding-bottom: 15px;
  font-size: 18px;
  line-height: 12px;
  margin: 10px 5px 0px 5px;
}

.main-form__input {
  margin-bottom: 15px;
  width: 85%;
  padding-left: 15px;
  height: 30px;
  background: #FFFFFF;
  box-shadow: 2px 2px 2px rgba(0, 0, 0, 0.2);
  border-radius: 5px;
  border: none;
  font-size: 14px;
  letter-spacing: 0.05em;
  font-weight: 400;
  color: #5B5B5B;
}

.button1 {
  width: 70px;
} 

.button2 {
  width: 106px;
} 

.button3 {
  width: 60px;
} 

.button4 {
  width: 100px;
} 

.button:hover { background: rgb(232,95,76); } /* при наведении курсора мышки */
.button:active { background: rgb(152,15,0); } /* при нажатии */

.table-title {
  display: flex;
  padding: 20px;
}

.table-caption__column,.table-title__column {
  padding-left: 15px;
}

.main-form__wrap-image {
  max-width: 190px;
}

.main-form__image {
  width: 100%;
  height: 100%;
}

.main-form__right {
  display: flex;
  flex-direction: row;
}

.worker-item__legend {
    width: 98%;
    min-height: 40px;
    background: #FFFFFF;
    box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.15);
    border-radius: 5px;
    display: grid;
    grid-template-columns: minmax(auto, 100px) minmax(auto, 180px) minmax(auto, 150px) minmax(auto, 210px) minmax(auto, 200px) minmax(auto, 290px);
    padding-left: 30px;    
    align-items: center;
    margin-bottom: 15px;
    margin-top: 15px;
    background: rgba(0, 0, 0, 0.05);
    padding-top: 10px;
    padding-bottom: 10px;

}

</style>
