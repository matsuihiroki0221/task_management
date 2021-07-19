//import { vue } from "laravel-mix";

import Vue from "vue";
import Router from "vue-router";
import Home from "./views/Home";
import TaskDetail from "./views/MyTask/TaskDetail";
import EveryTaskList from "./views/MyTask/EveryTaskList";
import TaskCreate from "./views/MyTask/TaskCreate";
import TaskEdit from "./views/MyTask/TaskEdit";
import ProjectCreate from "./views/Project/ProjectCreate";
import ProjectDetail from "./views/Project/ProjectDetail";
import ProjectEdit from "./views/Project/ProjectEdit";
import TaskforProject from "./components/TaskforProject";
import Login from "./Login/Login";
import About from "./Login/About";
Vue.use(Router);

const router =  new Router ({
  mode: "history",
  routes: [
    {
      path: '/',
      name:'login',
      component: Login,
      meta: { guestOnly: true }
    },
    {
      path: "/about",
      name: "about",
      component: About,
      meta: { authOnly: true }
    },
    {
      path: '/home',
      name: 'Home',
      component:Home,
      props: true,
      meta: { authOnly : true}
    },
    {
      path:'/tasks/:taskId',
      name: 'task_edit',
      component: TaskEdit,
      props: true,
      meta: { authOnly : true}
    },
    {
      path: '/task_create',
      name: 'task_create',
      component: TaskCreate,
      meta: { authOnly : true}
    },
    {
      path: '/project_create',
      name: 'project_create',
      component: ProjectCreate,
      meta: { authOnly : true}
    },
    {
      path:'/taskdetail/:taskId',
      name: 'task_detail',
      component:TaskDetail,
      props: true,
      meta: { authOnly : true},
      children: [
        {
          path:'comment',
          component:Comment,
          props:true
        },
      ]
    },
    {
      path:'/everytasklist/:projectId',
      name:'every_task_detail',
      component:EveryTaskList,
      props: true,
      meta: { authOnly : true}
    },
    {
      path:'/projectdetail/:projectId',
      /* name:'project_detail', */
      component:ProjectDetail,
      props:true,
      meta: { authOnly : true},
      children: [
        {
          path:'taskforproject',
          component:TaskforProject,
          props:true,
        }
      ]
    },
    {
      path:'/projectedit/:projectId',
      name:'project_edit',
      component:ProjectEdit,
      props:true,
      meta: { authOnly : true}
    }
  ]
});

function isLoggedIn() {
  return localStorage.getItem("auth");
}

router.beforeEach((to, from, next) => {
  if (to.matched.some(record => record.meta.authOnly)) {
      if (!isLoggedIn()) {
          next("/");
      } else {
          next();
      }
  } else if (to.matched.some(record => record.meta.guestOnly)) {
      if (isLoggedIn()) {
          next("/about");
      } else {
          next();
      }
  } else {
      next();
  }
});
export default router;