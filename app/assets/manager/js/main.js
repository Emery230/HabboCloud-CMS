
/**
 * This function just returns a nice object with the properties built.
 * This could have also been defined itself in the stories array.
 * @param {*} id 
 * @param {*} type 
 * @param {*} length 
 * @param {*} src 
 * @param {*} preview 
 * @param {*} link 
 * @param {*} seen 
 * @param {*} time 
 */
function buildItem(id, type, length, src, preview, link, seen, time) {
// Using object short-hand (id: id)
  return {
    id,
    type,
    length,
    src,
    preview,
    link,
    seen,
    time,
  };
}

/**
 * Creates Zuck stories. 
 */
const stories = new Zuck('stories', {
  backNative: true,
  autoFullScreen: 'false',
  skin: 'snapssenger',
  avatars: 'true',
  list: false,
  cubeEffect: 'true',
  localStorage: true,
  stories: [
	  {
      id: '1',
      photo: 'https://habbo.cloud/app/assets/images/avatars/JooqXSsFWmVQI2boPKv9hSfpAFJwLTxllkOxdSU1.jpg',
      name: 'Profesor',
      link: '',
      lastUpdated: 1522528209,
      items: [
        buildItem('1', 'photo', 3, 'https://habbo.cloud/app/assets/images/storie.png', '', '', false, 1522528209),
      ],
    },
  ],
});


