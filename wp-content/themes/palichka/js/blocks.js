
const setExtraPropsToBlockType = (props, blockType, attributes) => {
  const notDefined = (typeof props.className === 'undefined' || !props.className) ? true : false

  if (blockType.name === 'core/heading') {
    return Object.assign(props, {
      className: notDefined ? `h2` : `h2 ${props.className}`,
    });
  }

  if (blockType.name === 'core/image') {
    return Object.assign(props, {
      className: notDefined ? `photo` : `photo ${props.className}`,
    });
  }

  if (blockType.name === 'core/paragraph') {
    return Object.assign(props, {
      className: notDefined ? 'additional-text' : `additional-text ${props.className}`,
    });
  }

  return props;
};

wp.hooks.addFilter(
  'blocks.getSaveContent.extraProps',
  'palichka/block-filters',
  setExtraPropsToBlockType
);