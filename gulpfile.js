const { src, dest, parallel } = require("gulp");
const responsive = require("gulp-responsive");
const { dirname } = require('path')

function outputOnOriginalFolder(file) {
  const first = file.history[0]
  return dirname(first)
}

function createResponsiveTask(glob) {
  return () =>
    src(glob)
      .pipe(
        responsive(
          {
            "*": [
              ...[576, 768, 992, 1200].map((bp) => {
                return {
                  width: bp,
                  rename: {
                    suffix: `-${bp}px`,
                  },
                };
              }),
              {},
            ],
          },
          {
            withMetadata: false,
            skipOnEnlargement: true,
            errorOnEnlargement: false,
            format: "webp",
          }
        )
      )
      .pipe(dest(outputOnOriginalFolder));
}

const scaleDownTask = () => src(["public/assets/img/bendera/**/*.png"])
  .pipe(responsive({
    "*": {
      width: "20px",
      rename: {
        suffix: "-20px"
      }
    }
  }, {
    withMetadata: false,
    format: "webp"
  }))
  .pipe(dest(outputOnOriginalFolder));

// exports.default = parallel([responsiveTask, scaleDownTask])
exports.responsive = parallel([
  createResponsiveTask("public/assets/img/hero/*.jpg"),
  createResponsiveTask("public/assets/img/*.png")
]);

exports.scaledown = parallel([
  scaleDownTask
])
