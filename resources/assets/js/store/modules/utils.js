import axios from "axios/index";

const state = {
  mobile : /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test ( navigator.userAgent ),
  modalAddChanelTelegram : {
    open : false
  },
  galleryPhoto : {
    url : '',
    open : false
  },
  listChannel : [],
  listPost : [],
  loadPost : true,
  loadMore : false,
  statusAddRequest : false,
  swipeMenu : {
    leftSwipe : false,
    rightSwipe : false,
    home : true
  }
}
const mutations = {
  TOGGLE_MODAL_TELEGRAM : ( state ) => {
    state.modalAddChanelTelegram.open = !state.modalAddChanelTelegram.open
  },
  STATUS_ADD_CHANNEL : ( state ) => {
    state.statusAddRequest = !state.statusAddRequest
  },
  LIST_CHANNEL : ( state, list ) => {
    state.listChannel = list
  },
  LIST_POST : ( state, post ) => {
    state.listPost = post
    state.loadPost = false
  },
  LOAD_MORE : ( state, post ) => {
    state.listPost = state.listPost.concat ( post )
    state.loadMore = false
  },
  OPEN_GALLERY : ( state, status ) => {
    state.galleryPhoto.url = status.url
    state.galleryPhoto.open = status.open
  },
  SWIPE_MENU : ( state, status ) => {
    state.swipeMenu.leftSwipe = status.leftSwipe
    state.swipeMenu.rightSwipe = status.rightSwipe
    setTimeout ( () => {
      state.swipeMenu.home = status.home
    }, 100 )

  }
}
const actions = {
  RELOAD : () => {
    window.location.reload ( "true" )
  },
  SWIPE_MENU : ( { commit, state } ) => {
    if ( !state.galleryPhoto.open ) {
      if ( state.mobile ) {
        let initialPoint;
        let finalPoint;
        document.addEventListener ( 'touchstart', ( event ) => {
          // event.preventDefault();
          // event.stopPropagation();
          initialPoint = event.changedTouches[ 0 ];
        }, false );
        document.addEventListener ( 'touchend', ( event ) => {
          // event.preventDefault();
          // event.stopPropagation();
          finalPoint = event.changedTouches[ 0 ];
          let xAbs = Math.abs ( initialPoint.pageX - finalPoint.pageX );
          let yAbs = Math.abs ( initialPoint.pageY - finalPoint.pageY );
          if ( xAbs > 50 || yAbs > 50) {
            if ( xAbs > yAbs ) {
              if ( finalPoint.pageX < initialPoint.pageX ) {
                if ( !state.galleryPhoto.open || state.swipeMenu.home ) {
                  if ( !state.swipeMenu.leftSwipe && !state.swipeMenu.rightSwipe && state.swipeMenu.home && !state.galleryPhoto.open ) {
                    commit ( 'SWIPE_MENU', {
                      leftSwipe : true,
                      rightSwipe : false,
                      home : false
                    } )
                    document.body.style.overflow = 'hidden'
                  }
                }
                if ( !state.swipeMenu.home ) {
                  if ( !state.swipeMenu.leftSwipe && state.swipeMenu.rightSwipe && !state.swipeMenu.home && !state.galleryPhoto.open ) {
                    commit ( 'SWIPE_MENU', {
                      leftSwipe : false,
                      rightSwipe : false,
                      home : true
                    } )
                    document.body.style.overflow = ''
                  }
                }
                /*СВАЙП ВЛЕВО*/
              }
              else {
                if ( state.swipeMenu.leftSwipe && !state.swipeMenu.rightSwipe && !state.swipeMenu.home && !state.galleryPhoto.open ) {
                  // alert ( 'СВАЙП ВПРАВО' )
                  if ( state.swipeMenu.leftSwipe ) {
                    commit ( 'SWIPE_MENU', {
                      leftSwipe : false,
                      rightSwipe : false,
                      home : true
                    } )
                    document.body.style.overflow = ''
                  }
                } else if ( !state.swipeMenu.leftSwipe && !state.swipeMenu.rightSwipe && state.swipeMenu.home  && !state.galleryPhoto.open) {
                  commit ( 'SWIPE_MENU', {
                    leftSwipe : false,
                    rightSwipe : true,
                    home : false
                  } )
                  document.body.style.overflow = 'hidden'
                }
                /*СВАЙП ВПРАВО*/
              }
            }
            else {
              if ( finalPoint.pageY < initialPoint.pageY ) {
                // alert('СВАЙП ВВЕРХ')
                /*СВАЙП ВВЕРХ*/
              }
              else {
                // alert('СВАЙП ВНИЗ')
                /*СВАЙП ВНИЗ*/
              }
            }
          }
        }, false );
      } else if ( document.documentElement.clientWidth <= 991 ) {
        var div = document.createElement('div');
        div.style.overflowY = 'scroll';
        div.style.width = '50px';
        div.style.height = '50px';
        div.style.visibility = 'hidden';
        document.body.appendChild(div);
        var scrollWidth = div.offsetWidth - div.clientWidth;
        document.body.removeChild(div);
        document.body.style.paddingRight = ''
        document.onmousedown = e => {
          if ( document.documentElement.clientWidth <= 991 ) {
            let right = 0
            let left = 0
            let currentX = e.clientX
            var selected_text = window.getSelection () || document.selection.createRange ().text;
            document.onmousemove = function ( ev ) {
              if ( selected_text.type !== 'Range' ) {
                if ( currentX + 120 >= document.documentElement.clientWidth && currentX > ev.clientX ) {
                  window.getSelection ().removeAllRanges ();
                  right += 5
                  if ( right >= 60 ) {
                    if ( !state.galleryPhoto.open || state.swipeMenu.home ) {
                      if ( !state.swipeMenu.leftSwipe && !state.swipeMenu.rightSwipe && state.swipeMenu.home ) {
                        commit ( 'SWIPE_MENU', {
                          leftSwipe : true,
                          rightSwipe : false,
                          home : false
                        } )
                        document.body.style.overflow = 'hidden'
                        document.body.style.paddingRight = `${scrollWidth}px`
                      }
                      if ( !state.swipeMenu.leftSwipe && state.swipeMenu.rightSwipe && !state.swipeMenu.home ) {
                        commit ( 'SWIPE_MENU', {
                          leftSwipe : false,
                          rightSwipe : false,
                          home : true
                        } )
                        document.body.style.overflow = ''
                        document.body.style.paddingRight = ''
                      }
                    }
                  }
                } else if ( currentX <= 60 && document.documentElement.clientWidth && currentX < ev.clientX ) {
                  window.getSelection ().removeAllRanges ();
                  left += 5
                  if ( left >= 30 ) {
                    if ( !state.galleryPhoto.open || state.swipeMenu.home ) {
                      if ( !state.swipeMenu.leftSwipe && !state.swipeMenu.rightSwipe && state.swipeMenu.home ) {
                        commit ( 'SWIPE_MENU', {
                          leftSwipe : false,
                          rightSwipe : true,
                          home : false
                        } )
                        document.body.style.overflow = 'hidden'
                        document.body.style.paddingRight = `${scrollWidth}px`
                      }
                      if ( state.swipeMenu.leftSwipe && !state.swipeMenu.rightSwipe && !state.swipeMenu.home ) {
                        document.body.style.paddingRight = ''
                        commit ( 'SWIPE_MENU', {
                          leftSwipe : false,
                          rightSwipe : false,
                          home : true
                        } )
                        document.body.style.overflow = ''
                        document.body.style.paddingRight = ''
                      }
                    }
                  }
                }
              }
            }
            document.ondragstart = function () {
              return false;
            };
            document.onmouseup = () => {
              document.onselectstart = null
              document.onmousemove = null;
            }
          }
        }
      }
    }
  },
  ADD_CHANNEL : ( { commit, dispatch }, link ) => {
    commit ( 'STATUS_ADD_CHANNEL' )
    return new Promise ( ( resolve, reject ) => {
      axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
      axios.post ( 'api/telegram/channel', { link } )
        .then ( response => {
          commit ( 'STATUS_ADD_CHANNEL' )
          dispatch ( 'LIST_CHANNEL' )
          resolve ( response )
        }, ( err ) => {
          commit ( 'STATUS_ADD_CHANNEL' )
        } )

    } )
  },
  LIST_CHANNEL : ( { commit }, link ) => {
    return new Promise ( ( resolve, reject ) => {
      axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
      axios.get ( 'api/telegram/channel' )
        .then ( response => {
          commit ( 'LIST_CHANNEL', response.data.data )
          resolve ( response )
        }, ( err ) => {
          commit ( 'STATUS_ADD_CHANNEL' )
        } )

    } )
  },
  LIST_POST : ( { commit, state }, link ) => {
    axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
    state.loadPost = true
    return new Promise ( ( resolve, reject ) => {
      axios.get ( 'api/telegram/posts/' )
        .then ( response => {
          commit ( 'LIST_POST', response.data.data )
          resolve ( response )
        }, ( err ) => {
          commit ( 'STATUS_ADD_CHANNEL' )
        } )

    } )
  },
  LOAD_MORE_POST : ( { commit, state } ) => {
    let lastPost = state.listPost.length - 1
    state.loadMore = true
    axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
    return new Promise ( ( resolve, reject ) => {
      axios.get ( 'api/telegram/posts/', {
        params : {
          id : state.listPost[ lastPost ].id || ''
        }
      } )
        .then ( response => {
          commit ( 'LOAD_MORE', response.data.data )
          resolve ( response )
        }, ( err ) => {
          state.loadMore = false
        } )

    } )
  },
  DELETE_CHANNEL : ( { commit, dispatch }, id ) => {
    axios.defaults.headers.common[ 'Authorization' ] = localStorage[ 'access-token' ]
    return new Promise ( ( resolve, reject ) => {
      axios.delete ( `api/telegram/channel/${id}` )
        .then ( response => {
          dispatch ( 'LIST_CHANNEL' )
          resolve ( response )
        }, ( err ) => {
          commit ( 'STATUS_ADD_CHANNEL' )
        } )

    } )
  }
}
const getters = {
  modalAddChanelTelegram : state => state.modalAddChanelTelegram,
  statusAddRequest : state => state.statusAddRequest,
  listChannel : state => state.listChannel.reverse (),
  listPost : state => state.listPost,
  loadPost : state => state.loadPost,
  loadMore : state => state.loadMore,
  galleryPhoto : state => state.galleryPhoto,
  swipeMenu : state => state.swipeMenu,
  mobile: state => state.mobile
}

export default {
  state,
  getters,
  mutations,
  actions
}