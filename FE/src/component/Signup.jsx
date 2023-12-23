import React from 'react'
import logo from '../assets/logoshop.png'
import {NavLink} from 'react-router-dom'

const Signup = () => {
  return (
    <div className='container mt-2' style={{height: 600}}>
        <div className='row d-flex justify-content-center py-5 shadow'  >
            <div className='d-flex justify-content-center'>
                <img src={logo} width={150} height={150} alt="logo" />
            </div>
           
            <div className=' col-md-auto h-25  border rounded pt-5 pb-3 shadow'>
                <div className="d-flex justify-content-center fs-3">SignUp</div>
                <input type="email" className="form-control my-2"  placeholder="Email"/>
                <input type="password"  className="form-control" aria-describedby="passwordHelpInline"
                 placeholder='Password'/> 
                <input type="password" id="inputPassword6" className="form-control my-2" aria-describedby="passwordHelpInline"
                 placeholder='Enter the password'/>            
                <div className='justify-content-center d-flex mt-2'>
                    <div>
                        <button className='btn btn-success my-3' style={{width:200}}>SignUp</button>
                        <div>
                        <NavLink to="/login"> <button onClick className='btn btn-outline-success' style={{width:200}}>Login</button></NavLink>
                        </div>
                    </div>
                  
                    
                </div>
                
            </div>
        
        </div>
    </div>
  )
}

export default Signup