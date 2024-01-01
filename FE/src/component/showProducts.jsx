import React from 'react'
import { useState, useEffect } from 'react'
import axios from 'axios'

import {NavLink} from 'react-router-dom'



const ShowProducts = () => {
  const [loading, setLoading] = useState(false);

  const [productData, setProductData] = useState([]);

 
  useEffect(() => {
    axios.get('http://nfruit.southeastasia.cloudapp.azure.com/api/v1/products')
    .then(Response => {
      setProductData(Response.data);
    })
    .catch(Error =>{
      console.log(Error);
    })
  }, []);
  
  console.log("data",productData);

  
  const Loading = () => {
    return(
      <>
       Loading ....
      </>
    )
  }


  return (
    <>
      
      {loading ? (
        
        <Loading/>
      ) : productData && (
        <>
          {
            productData.map(item => {
              return (
                <>
                  <div className="col-md-3 mb-4">
                    <div  className="card h-150 shadow text-center p-1" key={item.name}>
                      <img src={item.img} className=" h-50 card-img-top " alt={item.name} />
                      <div className="card-body ">
                        
                        <h5 className="card-title mb-0">{item.name }</h5>
                        <p className="card-text lead fw-bold">${item.price}</p>
                        <NavLink to={`/products/${item.name}`} className="btn btn-outline-secondary">Buy now</NavLink>
                      </div>
                    </div>
                  </div>

                </>
              )
            })
            
          }
        </>
      )}
     
    </>
  )
}

export default ShowProducts