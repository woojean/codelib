/* 计数排序 */

#include "stdio.h"
#include "stdlib.h"

#define LEN 26

void CountingSort(int arr[],int len){
  
  int i, min, max;
  min = max = arr[0];
  for(i = 1; i < len; i++) {
    if (arr[i] < min)
      min = arr[i];
    else if (arr[i] > max)
      max = arr[i];
  }
  
  int range = max - min + 1;
  int *count = (int*)malloc(range * sizeof(int));
  for(i = 0; i < range; i++){
    count[i] = 0;
  }
  for(i = 0; i < len; i++){
    count[ arr[i] - min ]++;
  }
  
  int j, z = 0;
  for(i = min; i <= max; i++){
    for(j = 0; j < count[ i - min ]; j++){
      arr[z++] = i;
    }
  }
  free(count);
}

int main(){
  
  int arr[LEN] = {18,15,1,2,19,20,3,12,13,14,20,15,20,4,5,6,7,16,17,10,15,8,9,10,11,20};
  int i;

  printf("array before sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]); 
  }
  
  CountingSort(arr,LEN);

  printf("\narray after sort:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]);
  }
  printf("\n");
}

