function delete_group(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Group Deleted Successfully',
            'success'
          )
        }
      })
}

function leave_group(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Deleted!',
            'Group Deleted Successfully',
            'success'
          )
        }
      })
}


function block_user(id){
    Swal.fire({
        title: 'Are You Sure?',
        text: "Do you Really want to block "+id+" ?!",
        icon: 'info',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
      }).then((result) => {
        if (result.isConfirmed) {
          Swal.fire(
            'Bloked!',
            id+' Is Now Blocked!  ',
            'success'
          )
        }
      })
}


function secondone() {
    var owl = $('.owl-carousel.secondone');
    owl.owlCarousel({
            center:true,
            animateOut: 'slideOutDown',
            items: 3,
            loop: false,
            margin: 3,
            dots: false,
            
        });
        owl.on('mousewheel', '.owl-stage', function (e) {
            if (e.deltaY > 0) {
                owl.trigger('next.owl');
            } else {
                owl.trigger('prev.owl');
            }
            e.preventDefault();
        });
    };
    s = setInterval(secondone, 500);

    