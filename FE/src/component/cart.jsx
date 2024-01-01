import React from 'react';
import { useDispatch } from 'react-redux';
import { useSelector } from 'react-redux';
import { useState, useEffect } from 'react';
import { delCart } from '../redux/action';



const ShoppingCart = () => {

  const product = useSelector((state) => state.HandleCart)
  const [cart, setCart] = useState()
  useEffect(() => {
    setCart(product)
   
  }, [])

  const dispatch = useDispatch()
    const DleteProduct = (product) => {
        dispatch(delCart(product))
    }
  
  let totalPrice = 0;
  if (cart && cart.length > 0) {
    for (let item of cart) {
      totalPrice += item.price * item.qty;
    }
  }

  const handleClickPlus = (item) => {
    setCart(prevCart => prevCart.map(prevItem => {
      if (prevItem.name === item.name) {
        return { ...prevItem, qty: prevItem.qty + 1 };
      }
      return prevItem;
    }));
  }

  const handleClickMinus = (item) => {
    setCart(prevCart => prevCart.map(prevItem => {
      if (prevItem.name === item.name && prevItem.qty > 1) {
        return { ...prevItem, qty: prevItem.qty - 1 }
      }
      return prevItem
    }));
  }

  const handleClickDle = (item) => {
    DleteProduct(item)
    setCart(prevCart => prevCart.filter((prevItem) => prevItem.name !== item.name ))
  }

  return (
    <div className='my-5 py-5'>
      <h1 className='display-6 fw-boder pb-5 text-center shadow-sm'>Shopping Cart</h1>

      {cart && cart.length > 0 &&
        cart.map(item => {
          let sum = (item.qty * item.price).toFixed(2)
          
         
          return (
            <div className=" container col-ms-3 text-center" >
              <div className="row">
                <div className="col">
                  <img className='mt-4   rounded shadow' src={`https://api.predic8.de${item.photo_url}`} alt={item.name}
                    width='150px' height='100px'
                  />
                </div>
                <div className="col align-items-center d-flex">
                  <h3>{item.name} </h3>
                  <br />
                  <h5 className='ms-2'> :$ {item.price}</h5>
                </div>
                <div className="col d-flex fs-2 pt-2 d-flex justify-content-center border">
                  <div className='' style={{width:300}}>
                    <div className='float-end'>
                      <button className='float-end btn' onClick={() => handleClickDle(item)}><i class="fa-solid fa-x"></i></button>
                    </div>
                    <div className='ms-3 pt-2 mb-3 '> ${sum}</div>

                    <div className='row d-block pb-3'>
                      <button onClick={() => handleClickMinus(item)} className=' btn btn-outline-dark  rounded-5  ' style={{ width: 40, height: 40 }}> <i className="fa-solid fa-minus"></i></button>
                      <span className='mx-2'>{item.qty}</span>

                      <button onClick={() => handleClickPlus(item)} className='  btn btn-outline-dark rounded-5  ' style={{ width: 40, height: 40 }}><i className="fa-solid fa-plus"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <hr />
              
            </div>
          )
        })

      }
      {cart && cart.length>0&&
         <div className='container row ms-5 mt-5 justify-content-center' >
         <div className=" border   px-0 " style={{ height: 250, width: 400 }}>
           <div className='d-flex justify-content-center align-items-center' style={{height:150}} >
             <div className='d-inline fs-2' >Total price: $ {totalPrice.toFixed(2)}</div>
             
           </div>
           <hr />
           <button className="btn btn-danger " style={{width:400,height:50}}>Checkout</button>
         </div>
 
       </div>
     
      }
     </div>
  );
};

export default ShoppingCart;