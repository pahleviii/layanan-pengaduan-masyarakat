import { createRouter, createWebHistory } from 'vue-router';

// Import views
import Home from '../views/Home.vue';
import ComplaintForm from '../views/ComplaintForm.vue';
import ComplaintTracking from '../views/ComplaintTracking.vue';
import ResolvedComplaints from '../views/ResolvedComplaints.vue';
import Contact from '../views/Contact.vue';
import FAQ from '../views/FAQ.vue';
import About from '../views/About.vue';
import AdminLogin from '../views/Admin/Login.vue';
import AdminDashboard from '../views/Admin/Dashboard.vue';
import AdminComplaints from '../views/Admin/Complaints.vue';

const routes = [
    // Public routes
    { path: '/', name: 'Home', component: Home },
    { path: '/complaint/form', name: 'ComplaintForm', component: ComplaintForm },
    { path: '/complaint/tracking', name: 'ComplaintTracking', component: ComplaintTracking },
    { path: '/complaint/resolved', name: 'ResolvedComplaints', component: ResolvedComplaints },
    { path: '/contact', name: 'Contact', component: Contact },
    { path: '/faq', name: 'FAQ', component: FAQ },
    { path: '/about', name: 'About', component: About },
    
    // Admin routes
    { path: '/admin/login', name: 'AdminLogin', component: AdminLogin },
    { 
        path: '/admin/dashboard', 
        name: 'AdminDashboard', 
        component: AdminDashboard,
        meta: { requiresAuth: true }
    },
    { 
        path: '/admin/complaints', 
        name: 'AdminComplaints', 
        component: AdminComplaints,
        meta: { requiresAuth: true }
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes
});

// Navigation guard untuk protected routes
router.beforeEach((to, from, next) => {
    const token = localStorage.getItem('token');
    
    if (to.meta.requiresAuth && !token) {
        next('/admin/login');
    } else {
        next();
    }
});

export default router;
