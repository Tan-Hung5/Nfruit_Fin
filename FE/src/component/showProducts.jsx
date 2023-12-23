import React from 'react'
import { useState, useEffect } from 'react'
import axios from 'axios'

import {NavLink} from 'react-router-dom'
import nock from 'nock/types'



// Giả mạo yêu cầu GET đến 'https://api.example.com/data' và trả về dữ liệu giả mạo
nock('https://api.example.com')
  .get('/data')
  .reply(200, { data: 'fake data' });

const ShowProducts = () => {
  const [loading, setLoading] = useState(false);

  const [productData, setProductData] = useState([]);

 
  useEffect(() => {
   
  }, []);
  
  console.log(productData);

  
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
              let img = `https://api.predic8.de${item.photo_url }`
              return (
                <>
                  <div className="col-md-3 mb-4">
                    <div className="card h-150 text-center p-1" key={item.name}>
                      <img src={img} className="card-img-top" alt={item.name} />
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