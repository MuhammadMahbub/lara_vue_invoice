import { createRouter, createWebHistory } from 'vue-router'

import InvoiceIndex from '../components/invoices/Index.vue'
import NotFound from '../components/404.vue'

const routes = [
    {
      path: '/',
      component: InvoiceIndex
    },
    {
      path: '/:any(.*)*',
      component: NotFound
    }
  ]

const router = createRouter({
    history: createWebHistory(import.meta.env.BASE_URL),
    routes
  })
  
  export default router