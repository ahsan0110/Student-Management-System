<template>
    <div class="container">
        <Sidebar @tab-selected="updateTab" />

        <div class="main-content">
            
            <router-view />
        </div>
    </div>
</template>

<script>
import Sidebar from "./components/Sidebar.vue";


export default {
    name: "App",
    components: {
        Sidebar,

    },
    data() {
        return {
            activeTab: "Students",
        };
    },
    methods: {
        updateTab(tab) {
            this.activeTab = tab;
        },
    },
};
</script>

<style>
.body {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    background-color: #e5ebf3;
    font-family: "Segoe UI", sans-serif;
}
h1{
    text-align: center;
    margin-bottom: 50px;
}
.sms{
    color: #f00000;
    font-weight: 700;
}

.container {
    display: flex;
    height: 100vh;
}

.book {
    width: 40px;
    height: 40px;
    display: block;
}

.main-content {
    flex-grow: 1;
    margin-left: 230px;
    padding: 2rem;
    background-color: #e5ebf3;
    color: #1e293b;
    font-family: "Segoe UI", sans-serif;
}

.add-student-page {
    padding: 2rem;
    background-color: #f8fafc;
    /* content area bg */
    min-height: 100vh;
}

.page-title {
    font-size: 1.8rem;
    margin-bottom: 1rem;
    color: #1e293b;
}

.student-form {
    
    display: flex;
    flex-direction: column;
    width: 60%; 
    gap: 5px;
}

.form-group {
    margin-bottom: 1rem;
}

.form-group label {
    display: block;
    font-weight: 500;
    margin-bottom: 0.5rem;
}

.form-group input {
    width: 100%;
    padding: 8px 12px;
    border: 1px solid #cbd5e1;
    border-radius: 0.25rem;
}

button[type="submit"] {
    padding: 10px 20px;
    background-color: #1e293b;
    color: #fff;
    border: none;
    border-radius: 0.25rem;
    cursor: pointer;
    font-weight: 500;
    transition: background 0.3s;
}

button[type="submit"]:hover {
    background-color: #334155;
}

.success {
    margin-top: 1rem;
    color: green;
}

.error {
    margin-top: 1rem;
    color: red;
}

table {
    position: relative;
    left: 50%;
    transform: translateX(-50%);
    border-collapse: collapse;
    width: 80%;
    border: 3px solid #243850;
}

th,
td {
    text-align: left;
}
th {
    background-color: #243850;
    color: #fff;
    padding: 12px 15px;
    font-weight: 600;
}
td {
    background-color: #f8f9fb;
    padding: 12px 15px;
    color: #333;
    border-bottom: 1px solid #ddd;
}



.add-enrollment-page {
    padding-left: 2rem;
    padding-right: 2rem;
    padding-bottom: 2rem;
    background-color: #f8fafc;
    min-height: 100vh;
}

.edit-student-page {
    padding: 2rem;
    background-color: #f8fafc;
    min-height: 100vh;
}

.sidebar {
    width: 230px;
    height: 100vh;
    background-color: #233850;
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-top: 1rem;
    position: fixed;
    font-family: inherit;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
    border-top-right-radius: 20px;
    border-bottom-right-radius: 20px;
}

/* Header */
.sidebar-header {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 0.5rem;
    margin-bottom: 2rem;
}



.sidebar-header h2 {
    font-size: 1.5rem;
    font-weight: 700;
    display: block;
}

/* Menu items */
.sidebar-menu {
    list-style: none;
    padding: 0;
    width: 100%;
}

.sidebar-menu li {
    font-weight: 500;
    border-left: 4px solid transparent;
}

.sidebar-menu li a {
    display: block;
    width: 100%;
    padding: 12px 20px;
    color: inherit;
    text-decoration: none;
}

.sidebar-menu li a:hover {
    background-color: #5cc2bc;
    color: #1e293b;
    border-left: 4px solid #000000;
    /* yellow left indicator on hover */
    width: 81%;
    color: #000000;
}

/* Active tab styles applied to li */
.sidebar-menu li.active {
    background-color:#5ec2bb ;
    /* content area background */
    color: #1e293b;
    /* dark text for content area */
    border-left: 4px solid #000000;
    /* yellow left indicator */
}
.submit-btn{
    background-color: #243850;
    color: #fff;
    margin-top: 20px;
    padding: 12px 25px;
    border: none;
    border-radius: 5px;
    font-size: 1rem;
    cursor: pointer;
    font-weight: 600;
    transition: background 0.3s ease, transform 0.1s ease;
    position: relative;
    left: 50%;
    transform: translateX(-50%);
}
.submit-btn:hover{
    background-color: #5bc2bc;
    transform: scale(1.02);
    position: relative;
    left: 50%;
    transform: translateX(-50%);
}
.edit-btn {
    background-color: #4caf50;
    color: white;
    border-radius: 7px;

}
.edit-btn:hover {
    background-color: #43a047;
}


.delete-btn {
    background-color: #e53935;
    color: white;
    margin-left: 10px;
    border-radius: 7px;
}
.delete-btn:hover {
    background-color: #c62828;
}
</style>
