export const handleCheckLinkImage = (url) => {
  if (url) {
    return url?.startsWith("https");
  }
};
