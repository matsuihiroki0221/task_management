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
import Login from "./Login/Login";
Vue.use(Router);

export default new Router ({
  mode: "history",
  routes: [
    {
      path: '/login',
      name:'Login',
      component: Login,
    },
    {
      path: '/1',
      name: 'Home',
      component:Home,
      props: true
    },
    {
      path:'/tasks/:taskId',
      name: 'task_edit',
      component: TaskEdit,
      props: true
    },
    {
      path: '/task_create',
      name: 'task_create',
      component: TaskCreate
    },
    {
      path: '/project_create',
      name: 'project_create',
      component: ProjectCreate,
    },
    {
      path:'/taskdetail/:taskId',
      name: 'task_detail',
      component:TaskDetail,
      props: true
    },
    {
      path:'/everytasklist/:projectId',
      name:'every_task_detail',
      component:EveryTaskList,
      props: true,
    },
    {
      path:'/projectdetail/:projectId',
      name:'project_detail',
      component:ProjectDetail,
      props:true
    },
    {
      path:'/projects/:projectId',
      name:'project_edit',
      component:ProjectEdit,
      props:true
    }
  ]
});