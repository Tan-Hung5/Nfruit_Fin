import React from 'react'
import {useEffect, useState} from 'react'
import { useParams } from 'react-router-dom'
import axios from 'axios'
import { NavLink } from 'react-router-dom'
import Skeleton from 'react-loading-skeleton'

import {addCart} from '../redux/action/index'
import { ToastContainer, toast } from 'react-toastify';
import 'react-toastify/dist/ReactToastify.css';



const Product = () => {
    const {name} = useParams()
    const [loading, setLoading] = useState(false);
    const [data, setData] = useState([])
    const [img, setImg] = useState('')

    // const addProduct = (product) => {
    //     dispatch(addCart(product))
    //     toast.success('Add success');
    // }

    const fetchData = async () => {
        
    };
      
    useEffect(() => {

        
        fetchData();
        
    }, []);
    
   
   
    const Loading = () => {
        return (
            <>
                
                Loading....
            </>
        )
    }

    const Show_product = () => {
        return (
            <>
                <div className="col-md-6 py-3 ps-5 mb-5"  >
                    <img className='mt-3 card-img-top rounded shadow' src={img || <Skeleton/>} alt={data.name}
                        height='400px' width='400px'
                    /> 
                </div>
                <div className="col-md-3 py-5  ms-4">
                    <h4 className='display-5 col-6'>{data.name || <Skeleton/>}</h4>
                    <h3 className="display-6 fw-bold my-4 placeholder-glow">$ {data.price || <Skeleton/>}</h3>
                    <button className="btn btn-outline-dark mt-2 me-2 placeholder-glow"   >
                        add to cart
                    </button>
                    
                    <NavLink className="btn btn-dark mt-2 placeholder-glow" to='/cart'>
                        go to cart
                    </NavLink>
                </div>
            </>
        )
    }

   

  return (
    <div className='container'>
        <div className="row justify-content-center">
            {loading ? <Loading/> : <Show_product/>}
        </div>
        <ToastContainer
            position="top-center"
            autoClose={1000}
            hideProgressBar={false}
            newestOnTop={false}
            closeOnClick
            rtl={false}
            pauseOnFocusLoss
            draggable
            pauseOnHover
            theme="dark"
        />
    </div>
  )
}

export default Product