console.log('cart');
var app = angular.module('dbApp',[]);

app.controller('cart', function ($scope) {
  
  $scope.items = items1;
  console.log($scope.items);
  $scope.itemsAtHome = dataAtHome;
  console.log(dataAtHome);

  $scope.sellingPrice = 0;

  $scope.cart = [];
  $scope.cartSell = [];
  $scope.total = 0;
  $scope.givenPrice = building.money_pack; 

  $scope.quantityBackup = angular.copy($scope.itemsAtHome);

  // function saveCart() {
  //   localStorage.setItem("shoppingCart", JSON.stringify($scope.cart));
  // }

  function loadCart() {
    $scope.cart = JSON.parse(localStorage.getItem("shoppingCart"));
    if ($scope.cart === null) {
      $scope.cart = []
    }
  }
  loadCart();

	$scope.countCart = function () { // -> return total count
    var totalCount = 0;
    for (var i in $scope.cart) {
        totalCount += $scope.cart[i].count;
    }
    totalCount;
    $('#counter').innerHTML = totalCount;
  };
	
  $scope.getCost = function(item) {
    return (item.count * item.price).toString().replace(/\B(?=(\d{3})+(?!\d))/g, " ");
  };

  $scope.addItem = function (product) {
    if ($scope.cart.length === 0){
	 		product.count = 1;
	 		$scope.cart.push(product);
	 	} else {
	 		var repeat = false;
	 		for(var i = 0; i< $scope.cart.length; i++){
	 			if($scope.cart[i].id === product.id && $scope.cart[i].type === product.type){
	 				repeat = true;
	 				$scope.cart[i].count +=1;
	 			}
	 		}
	 		if (!repeat) {
	 			product.count = 1;
	 		 	$scope.cart.push(product);	
	 		}
	 	}
    // saveCart();
  };

  $scope.sellItem = function (product) {
    if ($scope.cartSell.length === 0){
       product.count = 1;
       product.pivot.quantity --; 
	 		$scope.cartSell.push(product);
	 	} else {
	 		var repeat = false;
	 		for(var i = 0; i< $scope.cartSell.length; i++){
	 			if($scope.cartSell[i].id === product.id){
	 				repeat = true;
          $scope.cartSell[i].count +=1;
          product.pivot.quantity --; 
	 			}
	 		}
	 		if (!repeat) {
        product.pivot.quantity --; 
	 			product.count = 1;
	 		 	$scope.cartSell.push(product);	
      }
	 	}
    // saveCart();
  };
  
  $scope.sellingPrice = function() {
    var total = 0;
    angular.forEach($scope.cartSell, function(item) {
      total += item.price * item.count;
    })
    return total;
    // saveCart();
  }

  $scope.getTotal = function() {
    var total = 0;
    angular.forEach($scope.cart, function(item) {
      total += item.price * item.count;
    })
    return total;
    // saveCart();
  }

  $scope.getSellTotal = function(){
    var total = 0;
    angular.forEach($scope.cartSell, function(item){
      total += item.price * item.count;
    })
    return total;
    // saveCart();
  }

  app.filter('nospace', function () {
    return function (value) {
      return (!value) ? '' : value.replace(/ /g, '');
    };
	});

  $scope.clearCart = function() {
    $scope.cart.length = 0;
    $scope.total = 0;
    $scope.cartSell.length = 0;
    $scope.itemsAtHome = angular.copy($scope.quantityBackup);
    // saveCart();
  };
  
	$scope.removeItemCart = function(product){
	  if(product.count > 1){
	    product.count -= 1;
	  }
	  else if(product.count === 1){
	    var index = $scope.cart.indexOf(product);
			$scope.cart.splice(index, 1);
	  }
	  // saveCart();
  };

  $scope.removeItemSellCart = function(product){
	  if(product.count > 1){
      product.count -= 1;
      product.pivot.quantity++;
	  }
	  else if(product.count === 1){
	    var index = $scope.cartSell.indexOf(product);
      $scope.cartSell.splice(index, 1);
      product.pivot.quantity++;
	  }
	  saveCart();
  };

  $scope.removeItem = function(item) {
    var index = $scope.cart.indexOf(item);
    $scope.cart.splice(index, 1);
  	$scope.total = $scope.total - (item.price * item.count);
  	saveCart();
  };
});

app.controller('statistics', function ($scope) {
  $scope.currentSeason = statistics;
  $scope.level = level;
});


// var statistics = [
//   {
//     id: 1,
//     name: 'Rakha',
//     rank: 1,
//     link: '/guide.html'
//   },
//   {
//     id: 2,
//     name: 'Boho',
//     rank: 3,
//     link: '/guide.html'
//   },
//   {
//     id: 3,
//     name: 'Dave',
//     rank: 4,
//     link: '/guide.html'
//   },
//   {
//     id: 4,
//     name: 'Anvar',
//     rank: 2,
//     link: '/guide.html'
//   }
// ]

// var level = [
//   {
//     id: 1,
//     name: 'Rakha',
//     rank: 1,
//     link: '/guide.html'
//   },
//   {
//     id: 2,
//     name: 'Boho',
//     rank: 3,
//     link: '/guide.html'
//   },
//   {
//     id: 3,
//     name: 'Dave',
//     rank: 4,
//     link: '/guide.html'
//   },
//   {
//     id: 4,
//     name: 'Anvar',
//     rank: 2,
//     link: '/guide.html'
//   }
//   ,
//   {
//     id: 5,
//     name: 'Bob',
//     rank: 5,
//     link: '/guide.html'
//   }
// ]
// var data = [
//   {
//     id: 1,
//     name: 'lamp',
//     img: '/data/img/lamp.png',
//     desc: 'energy consuming is 78 KWatt',
//     type: 'energy consuming',
//     price: 60,
//     to: 'Purchasing'
//   },
//   {
//     id: 2,
//     name: 'solar panel',
//     img: '/data/img/solar.png',
//     desc: 'energy generating is 60 KWatt',
//     type: 'energy generating',
//     price: 130,
//     to: 'Purchasing'
//   },
//   {
//     id: 3,
//     name: 'lamp',
//     img: '/data/img/lamp.png',
//     desc: 'energy consuming is 78 KWatt',
//     type: 'energy consuming',
//     price: 100,
//     to: 'Purchasing'
//   },
// ]

// var dataAtHome = [
//   {
//     id: 1,
//     name: 'lamp',
//     img: '/data/img/lamp.png',
//     desc: 'energy consuming is 78 KWatt',
//     type: 'energy consuming',
//     price: 50,
//     quantity: 3,
//     to: 'Selling'
//   },
//   {
//     id: 2,
//     name: 'solar panel',
//     img: '/data/img/solar.png',
//     desc: 'energy generating is 60 KWatt',
//     type: 'energy generating',
//     price: 65,
//     quantity: 6,
//     to: 'Selling'
//   },
//   {
//     id: 3,
//     name: 'lamp',
//     img: '/data/img/lamp.png',
//     desc: 'energy consuming is 78 KWatt',
//     type: 'energy consuming',
//     price: 49,
//     quantity: 7,
//     to: 'Selling'
//   },
// ]