// Este es el archivo routes.js para evitar  el mismo error
import Vue from 'vue'
import Router from 'vue-router'

// importamos los componentes para usarlos
/********** Componentes De La Pagina Web **********/
import home from './views/EspecialesSemana'
import nuevo from './views/LoNuevo'
import dama from './views/P-Dama'
import caballero from './views/P-Caballero'
import ninas from './views/P-Ninas'
import ninos from './views/P-Ninos'
import diversos from './views/P-Diversos'
import contacto from './views/Contacto'
import membresia from './views/Membresias'
import pedcot from './views/PedidoCotizacion'
import confirmarcompra from './views/ConfirmarCompra'
import notFoundC from './views/Default'
import sesion from './views/Default'
import register from './views/Default'
/********** Componentes De La Administracion **********/
import agentes from './views/viewsAdmonGeneral/Agentes'
import articulos from './views/viewsAdmonGeneral/Articulos'
import disenos from './views/viewsAdmonGeneral/Designers'
import membresias from './views/viewsAdmonGeneral/MembresiasSolicitud'
import comentarios from './views/viewsAdmonGeneral/Comentarios'
import especiales from './views/viewsAdmonGeneral/Especiales'
import gastos from './views/viewsAdmonGeneral/Gastos'
import compras from './views/viewsAdmonGeneral/Compras'
import inventarios from './views/viewsAdmonGeneral/Inventarios'
import ventas from './views/viewsAdmonGeneral/Ventas'
import ventacancelada from './views/viewsAdmonGeneral/VentasCanceladas'

Vue.use(Router)


export default new Router({
    routes: [
    	{
            path: '/',
            name:'home',
            component: home
        },
        {
            path: '/cat-lonuevo',
            name:'l-nuevo',
            component: nuevo
        },
        {
            path: '/cat-dama',
            name:'l-dama',
            component: dama
        },
        {
            path: '/cat-caballero',
            name:'l-caballero',
            component: caballero
        },
        {
            path: '/cat-nina',
            name:'l-nina',
            component: ninas
        },
        {
            path: '/cat-nino',
            name:'l-nino',
            component: ninos
        },
        {
            path: '/cat-diversos',
            name:'l-diverso',
            component: diversos
        },
        {
            path: '/info-contacto',
            name:'l-contacto',
            component: contacto
        },
        {
            path: '/info-membresia',
            name:'l-membresia',
            component: membresia
        },
        {
            path: '/info-pc',
            name:'l-pc',
            component: pedcot
        },
        {
            path: '/confirmar_compra',
            name:'l-confirmar',
            component: confirmarcompra
        },
        {
            path: '/login',
            name:'login',
            component: sesion
        },
        {
            path: '*',            
            component: notFoundC
        },
/********** Rutas De La Administracion **********/
        {
            path: '/admon_agentes',
            name:'l-agentes',
            component: agentes
        },
        {
            path: '/admon_articulos',
            name:'l-articulos',
            component: articulos
        },
        {
            path: '/admon_desginers',
            name:'l-designers',
            component: disenos
        },
        {
            path: '/admon_membresias',
            name:'l-membresiasolicitud',
            component: membresias
        },
        {
            path: '/admon_comentarios',
            name:'l-comentarios',
            component: comentarios
        },
        {
            path: '/admon_especiales',
            name:'l-especiales',
            component: especiales
        },
        {
            path: '/admon_gastos',
            name:'l-gastos',
            component: gastos
        },
        {
            path: '/pdv_compras',
            name:'l-compras',
            component: compras
        },
        {
            path: '/pdv_inventarios',
            name:'l-inventarios',
            component: inventarios
        },
        {
            path: '/pdv_ventas',
            name:'l-ventas',
            component: ventas
        },
        {
            path: '/pdv_canceladas',
            name:'l-canceladas',
            component: ventacancelada
        }
    ],
    mode:"history" 
    
})