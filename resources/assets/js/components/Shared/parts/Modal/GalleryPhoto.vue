<template>
  <transition name="fade">
    <div class="modal_wrapper" @click.self.prevent="closeModal">
      <button class="btn btn-cancel" @click.prevent="closeModal">
        <svg class="icon icon-cancel">
          <use xlink:href="#icon-cancel"></use>
        </svg>
      </button>
      <div><img :src="url" class="images draggable" alt=""></div>
    </div>
  </transition>
</template>

<script>
export default {
  name : "GalleryPhoto",
  props : [ 'url' ],
  data () {
    return {
      isZoom : false,
      zoomStyle : {
        position : 'absolute',
        width : '100vh',
        top : '0',
        left : '0',
      }
    }
  },
  methods : {
    closeModal () {
      this.$store.commit ( 'OPEN_GALLERY', { url : '', open : false } )
      setTimeout ( () => {
        document.body.style.overflow = ''
        document.body.style.paddingRight = ''
      }, 200 )

    },
    close () {
      let vm = this
      let lastTap = 0;
      let timeout;
      let zoom = false
      document.addEventListener ( 'touchstart', function ( e ) {

        var dragElement = e.target;

        if ( !dragElement.classList.contains ( 'draggable' ) ) return;

        var coords, shiftX, shiftY;

        startDrag ( e.changedTouches[ 0 ].clientX, e.changedTouches[ 0 ].clientY );

        document.addEventListener ( 'touchmove', function ( e ) {
          moveAt ( e.changedTouches[ 0 ].clientX, e.changedTouches[ 0 ].clientY );
        } )

        dragElement.addEventListener ( 'touchend', function () {
                finishDrag ();
        } );


        // -------------------------

        function startDrag ( clientX, clientY ) {

          shiftX = clientX - dragElement.getBoundingClientRect ().left;
          shiftY = clientY - dragElement.getBoundingClientRect ().top;

          dragElement.style.position = 'fixed';
          dragElement.style.zIndex = 9001;

          // document.body.appendChild(dragElement);

          moveAt ( clientX, clientY );
        };

        function finishDrag () {
          // конец переноса, перейти от fixed к absolute-координатам
          if ( parseInt ( dragElement.style.top ) < 0 || parseInt ( dragElement.style.top ) + dragElement.getBoundingClientRect ().height >= document.documentElement.clientHeight ) {
            vm.closeModal ()
          } else {
            dragElement.style.position = 'static';
          }
          dragElement.style.top = parseInt ( dragElement.style.top ) + 'px';


          document.addEventListener ( 'touchmove', null )

          dragElement.addEventListener ( 'touchend', null )
          document.onmousemove = null;
          dragElement.onmouseup = null;
        }

        function moveAt ( clientX, clientY ) {
          // новые координаты
          var newX = clientX - shiftX;
          var newY = clientY - shiftY;

          /*        // ------- обработаем вынос за нижнюю границу окна ------
                  // новая нижняя граница элемента
                  var newBottom = newY + dragElement.offsetHeight;

                  // если новая нижняя граница вылезает вовне окна - проскроллим его
                  if (newBottom > document.documentElement.clientHeight) {
                    // координата нижней границы документа относительно окна
                    var docBottom = document.documentElement.getBoundingClientRect().bottom;

                    // scrollBy, если его не ограничить - может заскроллить за текущую границу документа
                    // обычно скроллим на 10px
                    // но если расстояние от newBottom до docBottom меньше, то меньше
                    var scrollY = Math.min(docBottom - newBottom, 10);

                    // ошибки округления при полностью прокрученной странице
                    // могут привести к отрицательному scrollY, что будет означать прокрутку вверх
                    // поправим эту ошибку
                    if (scrollY < 0) scrollY = 0;



                    // резким движением мыши элемент можно сдвинуть сильно вниз
                    // если он вышел за нижнюю границу документа -
                    // передвигаем на максимально возможную нижнюю позицию внутри документа
                    newY = Math.min(newY, document.documentElement.clientHeight - dragElement.offsetHeight);
                  }


                  // ------- обработаем вынос за верхнюю границу окна ------
                  if (newY < 0) {
                    // проскроллим вверх на 10px, либо меньше, если мы и так в самом верху

                    var scrollY = Math.min(-newY, 10);
                    if (scrollY < 0) scrollY = 0; // поправим ошибку округления


                    // при резком движении мыши элемент мог "вылететь" сильно вверх, поправим его
                    newY = Math.max(newY, 0);
                  }


                  // зажать в границах экрана по горизонтали
                  // здесь прокрутки нет, всё просто
                  if (newX < 0) newX = 0;
                  // if (newX > document.documentElement.clientWidth - dragElement.offsetHeight) {
                  //   newX = document.documentElement.clientWidth - dragElement.offsetHeight;
                  // }*/

          dragElement.style.left = newX + 'px';
          dragElement.style.top = newY + 'px';
        }

        // отменим действие по умолчанию на mousedown (выделение текста, оно лишнее)
        return false;
      } )
      /*document.onmousedown = function ( e ) {

        var dragElement = e.target;

        if ( !dragElement.classList.contains ( 'draggable' ) ) return;

        var coords, shiftX, shiftY;

        startDrag ( e.clientX, e.clientY );

        document.onmousemove = function ( e ) {
          moveAt ( e.clientX, e.clientY );
        };

        dragElement.onmouseup = function () {
          finishDrag ();
        };


        // -------------------------

        function startDrag ( clientX, clientY ) {

          shiftX = clientX - dragElement.getBoundingClientRect ().left;
          shiftY = clientY - dragElement.getBoundingClientRect ().top;

          dragElement.style.position = 'fixed';
          dragElement.style.zIndex = 9001;

          // document.body.appendChild(dragElement);

          moveAt ( clientX, clientY );
        };

        function finishDrag () {
          // конец переноса, перейти от fixed к absolute-координатам
          // if ( parseInt ( dragElement.style.top ) < 120 ) {
          //   vm.closeModal ()
          // }
          dragElement.style.top = parseInt ( dragElement.style.top ) + 'px';
          dragElement.style.position = 'absolute';


          document.onmousemove = null;
          dragElement.onmouseup = null;
        }

        function moveAt ( clientX, clientY ) {
          // новые координаты
          var newX = clientX - shiftX;
          var newY = clientY - shiftY;

          // ------- обработаем вынос за нижнюю границу окна ------
          // новая нижняя граница элемента
          var newBottom = newY + dragElement.offsetHeight;

          // если новая нижняя граница вылезает вовне окна - проскроллим его
          if ( newBottom > document.documentElement.clientHeight ) {
            // координата нижней границы документа относительно окна
            var docBottom = document.documentElement.getBoundingClientRect ().bottom;

            // scrollBy, если его не ограничить - может заскроллить за текущую границу документа
            // обычно скроллим на 10px
            // но если расстояние от newBottom до docBottom меньше, то меньше
            var scrollY = Math.min ( docBottom - newBottom, 10 );

            // ошибки округления при полностью прокрученной странице
            // могут привести к отрицательному scrollY, что будет означать прокрутку вверх
            // поправим эту ошибку
            if ( scrollY < 0 ) scrollY = 0;

            window.scrollBy ( 0, scrollY );

            // резким движением мыши элемент можно сдвинуть сильно вниз
            // если он вышел за нижнюю границу документа -
            // передвигаем на максимально возможную нижнюю позицию внутри документа
            newY = Math.min ( newY, document.documentElement.clientHeight - dragElement.offsetHeight );
          }


          // ------- обработаем вынос за верхнюю границу окна ------
          if ( newY < 120 ) {
            // проскроллим вверх на 10px, либо меньше, если мы и так в самом верху

            var scrollY = Math.min ( -newY, 10 );
            if ( scrollY < 0 ) scrollY = 0; // поправим ошибку округления

            window.scrollBy ( 0, -scrollY );
            // при резком движении мыши элемент мог "вылететь" сильно вверх, поправим его
            newY = Math.max ( newY, 0 );
          }


          // зажать в границах экрана по горизонтали
          // здесь прокрутки нет, всё просто
          if ( newX < 0 ) newX = 0;
          if ( newX > document.documentElement.clientWidth - dragElement.offsetHeight - 120 ) {
            newX = document.documentElement.clientWidth - dragElement.offsetHeight - 120;
          }

          dragElement.style.left = newX + 'px';
          dragElement.style.top = newY + 'px';
        }

        // отменим действие по умолчанию на mousedown (выделение текста, оно лишнее)
        return false;
      }*/

    },
    swipe () {
      var initialPoint;
      var finalPoint;
      let self = this

      document.addEventListener ( 'touchstart', function ( event ) {
        initialPoint = event.changedTouches[ 0 ];
      }, false );
      document.addEventListener ( 'touchend', function ( event ) {
        finalPoint = event.changedTouches[ 0 ];
        var xAbs = Math.abs ( initialPoint.pageX - finalPoint.pageX );
        var yAbs = Math.abs ( initialPoint.pageY - finalPoint.pageY );
        if ( xAbs > 20 || yAbs > 20 ) {
          if ( xAbs > yAbs ) {
            if ( finalPoint.pageX < initialPoint.pageX ) {
              // alert('СВАЙП ВЛЕВО')
              /*СВАЙП ВЛЕВО*/
            }
            else {
              // alert('СВАЙП ВПРАВО')
              /*СВАЙП ВПРАВО*/
            }
          }
          else {
            if ( finalPoint.pageY < initialPoint.pageY ) {
              self.closeModal ()
              /*СВАЙП ВВЕРХ*/
            }
            else {
              // alert('СВАЙП ВНИЗ')
              /*СВАЙП ВНИЗ*/
            }
          }
        }
      }, false );
    }
    ,
  },
  computed : {
    width () {
      return document.querySelector ( '.images' ).width
    }
  }
  ,
  mounted () {
    // this.swipe ()
    window.addEventListener ( 'keyup', ( event ) => {
      if ( event.keyCode === 27 && this.open ) {
        this.closeModal ()
      }
    } )
  },
  created () {
    this.close ()
  }
}
</script>

<style scoped lang="scss">
  .check_mark {
    width: 80px;
    height: 107px;
    margin: 0 auto;
  }

  button {
    cursor: pointer;
    margin-left: 15px;
  }

  .hide {
    display: none;
  }

  .modal_wrapper {
    position: fixed;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    background-color: rgba(#000, .5);
    overflow: hidden;
    z-index: 9000;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100vh;
    &:hover .btn-cancel {
      color: #ffffff;
    }
    img {
      cursor: default;
      max-width: calc(100vw - 30px);
      max-height: calc(100vh - 120px);
      object-fit: contain;
    }
  }

  .fade-enter-active, .fade-leave-active {
    transition: opacity .3s;
  }

  .fade-enter, .fade-leave-to /* .fade-leave-active до версии 2.1.8 */
  {
    opacity: 0;
  }

  .btn-cancel {
    position: absolute;
    top: 15px;
    right: 15px;
    background: none;
    display: flex;
    color: #cccccc;
    &:hover {
      color: #ffffff;
    }
  }

</style>