import Vue from "vue";
import VueRouter from "vue-router";

import Login from "../pages/user/Login";
import Home from "../pages/home/Home";
import Userlist from "../pages/user/Userlist";
import CreateUser from "../pages/user/CreateUser";
import CreateUserConfirm from "../pages/user/CreateUserConfirm";
import profile from "../pages/user/profile";
import UpdateUser from "../pages/user/UpdateUser";
import UpdateUserConfirm from "../pages/user/UpdateUserConfirm";

import parentComponent from "../pages/home/parentComponent";
import childComponent from "../pages/home/childComponent";

import PasswordChange from "../pages/user/PasswordChange";
import createpost from "../pages/post/createpost";
import createpostconfirm from "../pages/post/createpostconfirm";
import postlist from "../pages/post/postlist";
import postupdate from "../pages/post/postupdate";
import postupdateconfirm from "../pages/post/postupdateconfirm";
import upload_csvfile from "../pages/post/upload_csvfile";
import store from "../store/index";

Vue.use(VueRouter);

/**
 * This is router setup for frontend side.
 */
const routes = [
    {
        path: "/vue/login",
        name: "login",
        component: Login
    },
    {
        path: "/vue/home",
        name: "home",
        component: Home,
        props: true,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/userlist",
        name: "userlist",
        component: Userlist,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/createuser",
        name: "createuser",
        component: CreateUser,
        meta: {
            authorize: [],
        }
    },
    {
        path: "/vue/createuserconfirm",
        name: "createuserconfirm",
        component: CreateUserConfirm,
        props: true,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/userprofile",
        name: "profile",
        component: profile,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/update",
        name: "UpdateUser",
        component: UpdateUser,
        props: true,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/updateconfirm",
        name: "UpdateConfirm",
        component: UpdateUserConfirm,
        props: true,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/changepassword",
        name: "changepassword",
        component: PasswordChange,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/createpost",
        name: "createpost",
        component: createpost,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/createpostconfirm",
        name: "createpostconfirm",
        component: createpostconfirm,
        props: true,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/postupdate/:id",
        name: "postupdate",
        component: postupdate,
        props: true,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/postupdateconfirm/:id",
        name: "postupdateconfirm",
        component: postupdateconfirm,
        props: true,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/postlist",
        name: "postlist",
        component: postlist,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/uploadfile",
        name: "uploadfile",
        component: upload_csvfile,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/parent",
        name: "parent",
        component: parentComponent,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/child",
        name: "child",
        component: childComponent,
        meta: {
            authorize: []
        }
    },
    {
        path: "/vue/*",
        redirect: "/vue/home"
    },
    ,
    {
        path: "/vue",
        redirect: "/vue/home"
    }
]

const router = new VueRouter({
    mode: "history",
    routes
});

/**
 * This is to handle and check authentication for routing.
 */
router.beforeEach((to, from, next) => {
    const loggedIn = store.getters.isLoggedIn;
    if (!loggedIn && to.name != "login") {
        return next("/vue/login");
    } else if (loggedIn && to.name == "login") {
        return next("/vue/home");
    }
    next();
});

export default router;