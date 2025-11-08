import { createRouter, createWebHistory } from "vue-router";

import Students from "./components/Students/Students.vue";
import AddStudent from "./components/Students/AddStudent.vue";
import EditStudent from "./components/Students/EditStudent.vue";

import Teacher from "./components/Teachers/Teachers.vue";
import AddTeacher from "./components/Teachers/AddTeacher.vue";
import EditTeacher from "./components/Teachers/EditTeacher.vue";

import Course from "./components/Courses/Courses.vue";
import AddCourse from "./components/Courses/AddCourse.vue";
import EditCourse from "./components/Courses/EditCourse.vue";

import Batch from "./components/Batches/Batches.vue";
import AddBatch from "./components/Batches/AddBatch.vue";
import EditBatch from "./components/Batches/EditBatch.vue";

import Enrollment from "./components/Enrollments/Enrollments.vue";
import AddEnrollment from "./components/Enrollments/AddEnrollment.vue";
import EditEnrollment from "./components/Enrollments/EditEnrollment.vue";

import Payment from "./components/Payments/Payments.vue";
import AddPayment from "./components/Payments/AddPayment.vue";
import EditPayment from "./components/Payments/EditPayment.vue";

const routes = [
    {
        path: "/students",
        component: Students,
    },
    {
        path: "/students/add",
        component: AddStudent,
    },
    {
        path: "/students/edit/:id",
        component: EditStudent,
        props: true,
    },

    {
        path: "/teachers",
        component: Teacher,
    },
    {
        path: "/teachers/add",
        component: AddTeacher,
    },
    {
        path: "/teachers/edit/:id",
        component: EditTeacher,
        props: true,
    },

    {
        path: "/courses",
        component: Course,
    },
    {
        path: "/courses/add",
        component: AddCourse,
    },
    {
        path: "/courses/edit/:id",
        component: EditCourse,
        props: true,
    },

    {
        path: "/batches",
        component: Batch,
    },
    {
        path: "/batches/add",
        component: AddBatch,
    },
    {
        path: "/batches/edit/:id",
        component: EditBatch,
        props: true,
    },

    {
        path: "/enrollments",
        component: Enrollment,
    },
    {
        path: "/enrollments/add",
        component: AddEnrollment,
    },
    {
        path: "/enrollments/edit/:id",
        component: EditEnrollment,
        props: true,
    },

    {
        path: "/payments",
        component: Payment,
    },
    {
        path: "/payments/add",
        component: AddPayment,
    },
    {
        path: "/payments/edit/:id",
        component: EditPayment,
        props: true,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
