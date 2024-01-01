import React from 'react'
import logo from '../assets/logoshop.png'
import { NavLink } from 'react-router-dom'


const Login = () => {
  return (
    <div className='container mt-2' style={{height: 600}}>
        <div className='row d-flex justify-content-center py-5 shadow' >
            <div className='d-flex justify-content-center'>
            <img src={logo} width={150} height={150} alt="logo" />
            </div>
           
            <div className=' col-md-auto h-25  border rounded pt-5 pb-3 shadow'>
                <div className="d-flex justify-content-center fs-3">Login</div>
                <input type="email" className="form-control my-2" id="inputemail" placeholder="Email"/>
                <input type="password" id="inputpassword" class="form-control" aria-describedby="passwordHelpInline" placeholder='Password'/>              
                <div className='justify-content-center d-flex mt-3'>
                    <div>
                        <button className='btn btn-success my-2' style={{width:200}}>Login</button>
                        <div>                     
                        <NavLink to="/register"> <button className='btn btn-outline-success' style={{width:200}}> SignUp</button></NavLink>
                        </div>                      
                    </div>                  
                </div>
                <div><a href="#">Forgot password</a></div>
            </div>
        
        </div>
    </div>
  )
}

export default Login