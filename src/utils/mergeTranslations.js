/**
 * Merge multiple translation objects into a single object.
 * @param {import("ckeditor5").Translations} base - The base translation object.
 * @param  {...import("ckeditor5").Translations} others - Other translation objects to merge.
 * @returns The merged translation object.
 */
export function mergeTranslations(base, ...others) {
  const merged = { ...base };

  for (const src of others) {
    for (const lang of Object.keys(src)) {
      if (!merged[lang]) {
        // Nếu ngôn ngữ chưa có trong base -> thêm nguyên
        merged[lang] = { ...src[lang] };
      } else {
        // Nếu đã có -> giữ nguyên property cũ, chỉ merge dictionary
        merged[lang] = {
          ...merged[lang],
          dictionary: {
            ...merged[lang].dictionary,
            ...src[lang].dictionary
          }
        };
      }
    }
  }

  return merged;
}
