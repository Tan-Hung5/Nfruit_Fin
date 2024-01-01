const cart = [];

const HandleCart = (state = cart , action) => {
    const product = action.payload
    switch (action.type) {
        case 'ADDITEM':
            const exist = state.find((x)=> x.name === product.name)
            if(exist){
                return state.map((x)=> x.name === product.name ? {...x, qty:x.qty + 1}:x)
            } else {
                const product = action.payload
                return [
                    ...state,
                    {
                        ...product,
                       qty: 1,
                    }
                    
                ]
            }
            break;
        
        
        case 'DELITEM':
            const exist1 = state.find((x)=> x.name === product.name)
            if(exist1){
                return state.filter((x)=> x.name !== exist1.name)
            }
            break;
        default:
            return state
            break;
    }
}

export default HandleCart