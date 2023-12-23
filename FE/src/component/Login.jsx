import React from 'react'
import logo from '../assets/logoshop.png'
import { NavLink } from 'react-router-dom'

handleClick = () => {
    email = document.getElementById('inputemail')
    password = document.getElementById('inputpassword')
    bodyjson = {
        email: email,
        password: passowrd
    }
    fetch('/auth/login', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({bodyjson}),
      })
        .then(response => response.json())
        .then(data => {
          // Handle the response
        })
        .catch(error => {
          console.error('Error:', error);
        });
}

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
                        <NavLink to="/register"> <button onClick={handleClick} className='btn btn-outline-success' style={{width:200}}> SignUp</button></NavLink>
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