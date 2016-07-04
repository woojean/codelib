/* 二分查找法 */

#include "stdio.h"

#define LEN 26

int HalfSearch(int arr[], int low, int high, int num)
{
  int mid;
  mid = (low+high) / 2;
  if( (low>=high) && (arr[mid]!=num) ){
    return -1;
  }
  else
  {
    if(arr[mid]==num){
      return mid;
    }
    else if(arr[mid]>num){
      high = mid-1;
    }
    else{ 
      low = mid+1;
    }
    return HalfSearch(arr,low,high,num);
  }
}


int main(){
  
  int arr[LEN] = {18,15,1,2,19,20,3,12,13,14,20,15,20,4,5,6,7,16,17,10,15,8,9,10,11,20};
  int i,index;

  printf("array for search:\n");
  for(i = 0; i < LEN; i++){
    printf("%d ",arr[i]); 
  }
  
  index = HalfSearch(arr,0,LEN-1,19);

  printf("\nindex of 19:%d\n",index);
}

