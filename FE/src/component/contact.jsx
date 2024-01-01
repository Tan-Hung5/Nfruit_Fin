import React from 'react'
import logo from '../assets/logoshop.png'
import '../sass/component-sass/contact.scss'
import { NavLink } from 'react-router-dom'

const  Contact = () => {
  return (
    <>
        <div className='  border contact '>
        <div className=" row px-5 ">
            <div className="col .bg-light-subtle">
                <a href='/web-shop-Nfruits' className='bold fs-4'><img src={logo} width={100} height={100} className='logo-contact fs-2' alt="logo" />Nfruit Shop</a>
                <div>
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#" className='mx-3'><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-linkedin mb-5"></i></a>
                    
                </div>
                <div><i class="fa-regular fa-copyright fs-5"></i>2023 by<a className='fs-6' href="https://www.facebook.com/ngocminh1215/">  Tan Hung</a> </div>
            </div>
            <div className="col align-items-center d-flex">
                <ul>
                    <li><i class="fa-solid fa-phone"></i>:.....</li>
                    <li><i class="fa-solid fa-envelope"></i>:.....</li>
                </ul>
                
            </div>
            <div className="col">
                <ul class="list-group">
                    <li class=" fs-4">Links</li>
                    <li class=""><NavLink to="/web-shop-Nfruits">Home</NavLink></li>
                    <li class=""><NavLink to="/products">Products</NavLink></li>
                    <li class=""><NavLink to="/cart">Cart</NavLink></li>                
                </ul>
            </div>
            
        </div>
    </div>
    <div className='container .bg-body'></div>
    </>
    
  )
}

export default  Contact