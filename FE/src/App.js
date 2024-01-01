import React from 'react'
import Home from './component/Home'
import Nav from './component/Nav'
import {Routes, Route } from 'react-router-dom'
import Products from './component/products'
import Product from './component/product'
import ShoppingCart from './component/cart'
import Contact from './component/contact'
import Login from './component/Login'
import Signup from './component/Signup'


function App() {
  return (
    <>
    
        <Nav/>
        <Routes>
          <Route exact path='/home' element={<Home/>}/>
          <Route  path='/products' element={<Products/>}/>
          <Route  path='/products/:name' element={<Product/>}/>
          <Route  path='/cart' element={<ShoppingCart/>}/>
          <Route  path='/login' element={<Login/>}/>
          <Route  path='/register' element={<Signup/>}/>
        </Routes>
        <Contact/>
        
    </>
  )
}

export default App

