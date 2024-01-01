import React from 'react'
import ShowProducts from './showProducts'
function Products() {
    
  
  return (
    <>
      <div className='container my-5 py-5'>
          <div className="row">
              <div className="col-12 mp-5">
                  <h1 className='display-6 fw-boder text-center'>Products</h1>
                  <hr/>
              </div>
          </div>
          <div className="row justify-content-center">
               <ShowProducts/> 
              
          </div>
      </div>
    </>
  )
}

export default Products


