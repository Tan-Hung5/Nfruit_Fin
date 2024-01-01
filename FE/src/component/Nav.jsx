import React from 'react';
import Logo from './logo/logo';
import { NavLink } from 'react-router-dom'
import '../sass/main.scss';
import { useSelector } from 'react-redux'
import { useState, useEffect, useRef } from 'react';
import axios from 'axios';

function Nav() {
  const state = useSelector((state) => state.HandleCart)
  const [showSearch, setShowSearch] = useState(false);
  const [searchTerm, setSearchTerm] = useState("");
  const [searchResults, setSearchResults] = useState([]);
  const [loading, setLoading] = useState(false);
  const [productData, setProductData] = useState([]);
  const [showResults, setShowResults] = useState(false)
  const productListRef = useRef(null);

  

  useEffect(() => {
    document.addEventListener('click', handleClickOutside);
    return () => {
      document.removeEventListener('click', handleClickOutside);
    };
  }, []);

  const handleClick = () => {
    setShowSearch(!showSearch);
    setSearchResults([])
    setSearchTerm("")
  }

  const setResults = (e) => {
    setShowResults(true)
  }

  const handleClickOutside = (event) => {
    if (productListRef.current && !productListRef.current.contains(event.target)) {
      setSearchResults([])
    }
  };



  const onchange = (e) => {
    setSearchTerm(e.target.value);
    if (!e.target.value) return (
      setSearchResults([])
    );

    const results = productData.filter((item) =>
      item.name.toLowerCase().includes(searchTerm.toLowerCase())
    );
    setSearchResults(results);
  }
  console.log('dataresults', searchResults)

  const Loading = () => {
    return (
      <div></div>
    )
  }
  return (
    <>
      <nav className="navbar navbar-expand-lg bg-light bg-white by-3 shadow-sm">

        <div className="container">
          <NavLink className="navbar-brand fs-4" to="/web-shop-Nfruits"><Logo /></NavLink>
          <button className="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span className="navbar-toggler-icon"></span>
          </button>
          <div className="collapse navbar-collapse" id="navbarSupportedContent">
            <ul className="navbar-nav mx-auto mb-2 mb-lg-0">
              <li className="nav-item">
                <NavLink className="nav-link active fs-4" aria-current="page" to="/web-shop-Nfruits">Home</NavLink>
              </li>
              <li className="nav-item">
                <NavLink className="nav-link fs-4" to="/products">Product</NavLink>
              </li>
              <li className="nav-item">
                <NavLink className="nav-link fs-4" to="/contact">Contact</NavLink>
              </li>

            </ul>
            <button onClick={handleClick} className='border border-0 btn bi bi-search' id="button-addon1"  >

            </button>
            <div className='position-relative search' >
              {showSearch && (

                    <input type="text"  className=" rounded search" placeholder="Search..."
                      onChange={(e) => onchange(e)}
                      value={searchTerm}
                      aria-describedby="button-addon1" 
                      onFocus={(e) => setResults(e)}/>
                   
              )}
              {showResults && (
                 <ul className="list-group list-search position-absolute "  style={{ width: 250 }}>
                 <div>
                   {loading ? (
                     <Loading />
                   ) : searchResults && (
                     searchResults.map(item => {
                       let img = `https://api.predic8.de${item.photo_url}`
                       let href = item.name
                       return (
                         <li className='list-group-item'  ref={productListRef} key={item.name}  >
                           <NavLink to={`/products/${href}`}>
                             <span><img src={img} width={50} height={50} alt="img" /></span> |
                             <span>{item.name}</span>
                           </NavLink>
                         </li>
                       )
                     })
                   )
                   }
                 </div>
               </ul>
              )}
            </div>

            <div className="buttons">
              <NavLink to="/login" className="btn ms-2">
                <i className='fa fa-sign-in me-1 '></i> Login </NavLink>
            </div>
            <div className="buttons">
              <NavLink to="/register" className="btn ms-2">
                <i className='fa fa-user-plus me-1 '></i> Register </NavLink>
            </div>
            <div className="buttons">
              <NavLink to="/cart" className="btn ms-2 ">
                <i className='fa fa-shopping-cart me-1 '></i> Cart({state.length}) </NavLink>
            </div>
          </div>
        </div>
      </nav>

    </>
  )
}

export default Nav
